<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Event\EventInterface;
use Cake\Event\EventListenerInterface;

class AccountMailer extends Mailer
    implements EventListenerInterface
{
    public function confirm(){
        //I need account object here to access an email
        $this->setTransport('gmail')
             ->setEmailFormat('html')
         //droped 'from' as they say gmail checks if I actually control the domain
         //->setFrom(['reg@cakeinthesky.com' => 'Cake in the Sky Project (No Reply)'])
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
            //generate token here
            //update account with a new token here
            //then pass it to my confirm method, so I can add it to the message body
            $this->send('confirm');
        }
    }

}
