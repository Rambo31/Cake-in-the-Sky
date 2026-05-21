<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Accounts Controller
 *
 * @property \App\Model\Table\AccountsTable $Accounts
 */
class AccountsController extends AppController
{
    public function initialize(): void {
        // Always enable the FormProtection component.
        $this->loadComponent('FormProtection');

        //adding AccountMailer as an event listner
        //I use this to send confirmation emails
        $this->Users->getEventManager()->on($this->getMailer('Account'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Accounts->find();
        $accounts = $this->paginate($query);

        $this->set(compact('accounts'));
    }

    /**
     * View method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $account = $this->Accounts->get($id);
        $this->set(compact('account'));
    }

    /**
     * Register method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful register, renders view otherwise.
     */
    public function register()
    {
        //I need try catch block here
        $account = $this->Accounts->newEmptyEntity();
        try {
            //when u just open a form there is no post method in it
            if (!$this->request->is('post')) {
                return;
            }
            //get token from form POST
            $hcaptchaToken = $this->request->getData('h-captcha-response');
            if(!$hcaptchaToken){
                throw new \Exception('Missing hCaptcha token', 400);
            }
            //verify token with hCaptcha API
            $verificationResult = $this->verifyCaptchaToken($hcaptchaToken, $_SERVER['REMOTE_ADDR']);
            //decision login
            //fail
            if(!$verificationResult[0]){
                //I also can get additional error codes from $verificationResult[1]
                throw new \Exception('hCaptcha token verification failed', 403);
            }
            //success
            $account = $this->Accounts->patchEntity($account, $this->request->getData());
            if ($this->Accounts->save($account)) {
                $this->Flash->success(__('The account has been saved.'));

                return $this->redirect([
                    'controller' => 'Privacies',
                    'action' => 'showEmailConfirmation'
                ]);
            } else {
                //error 409 "Conflict" here, I guess the error can be due to some unique rules for accounts
                throw new \Exception('The account could not be saved. Please, try again', 409);
            }
        } catch(\Exception $e) {
            $this->Flash->error(__('Exception: ' . $e->getMessage() . '. Code: ' . $e->getCode()));
        } finally {
            $this->set(compact('account'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $account = $this->Accounts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $account = $this->Accounts->patchEntity($account, $this->request->getData());
            if ($this->Accounts->save($account)) {
                $this->Flash->success(__('The account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account could not be saved. Please, try again.'));
        }
        $this->set(compact('account'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $account = $this->Accounts->get($id);
        if ($this->Accounts->delete($account)) {
            $this->Flash->success(__('The account has been deleted.'));
        } else {
            $this->Flash->error(__('The account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function verifyCaptchaToken(string $token, string $ip): array {
        $payload = http_build_query([
            "secret" => env('HCAPTCHA_SECRET_KEY', false),
            "response" => $token,
            "remoteip" => $ip,
            "sitekey" => "372c53b6-0f12-4fe6-9b94-dc42dc16d902",
        ]);
        $ctx = stream_context_create([
            "http" => [
                "method" => "POST",
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "content" => $payload,
                "timeout" => 5,
            ],
        ]);
        $raw = file_get_contents(
            "https://api.hcaptcha.com/siteverify",
            false,
            $ctx
        );
        $j = json_decode($raw, true);
        if (!empty($j["success"])) {
            return [true, []];
        }
        return [false, $j["error-codes"] ?? []];
    }
}
