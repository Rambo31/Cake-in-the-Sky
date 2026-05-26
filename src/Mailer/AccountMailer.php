<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

class AccountMailer extends Mailer
{
    public function confirm(){
        //I need account object here to access an email
        $this->emailTransport('gmail')
             ->setEmailFormat('html')
             ->setFrom(['reg@cakeinthesky.com' => 'Cake in the Sky Project (No Reply)'])
         //change to account's email when go IRL
             ->setTo( env('MY_EMAIL_FOR_TESTING', false) )
             ->setSubject('Confirm New Account');
    }

    public function implementedEvents(): array
    {
        return [
            'Account.afterSave' => 'onRegistration',
        ];
    }

    public function onRegistration(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->isNew()) {
            $this->send('confirm');
        }
    }

}
