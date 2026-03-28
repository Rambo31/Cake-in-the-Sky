<?php
namespace App\Controller;

class ArticlesController extends AppController
{
    public function index(): void
    {
        $this->Authorization->skipAuthorization();
        $articles = $this->paginate($this->Articles); //fetch paginated set of Articles
        $this->set(compact('articles')); //pass articles into the Template
    }

    public function view(?string $slug): void
    {
        $this->Authorization->skipAuthorization();
        $article = $this->Articles
                        ->findBySlug($slug)
                        ->firstOrFail(); //query
        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        $this->Authorization->authorize($article);
        if ($this->request->is('post')) { //for saving form's data
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            $article->account_id = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article); //for rendering empty form
    }

    public function edit(?string $slug)
    {
        $article = $this->Articles
                        ->findBySlug($slug)
                        ->firstOrFail();
        $this->Authorization->authorize($article);

        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData(), [
                // Added: Disable modification of account_id.
                'accessibleFields' => ['account_id' => false],
            ]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('article', $article);
    }

    public function delete(?string $slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->Authorization->authorize($article);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));

            return $this->redirect(['action' => 'index']);
        }
    }
}
