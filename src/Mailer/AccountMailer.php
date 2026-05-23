<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

class AccountMailer extends Mailer
{
    public function confirm(){
        $this->setEmailFormat('html')
               ->setFrom(['me@example.com' => 'Cake in the Sky'])
               ->setTo('you@example.com')
               ->setSubject('About');
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
