<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

class AccountMailer extends Mailer
{
    public function confirm(){
        $mailer = new Mailer('default');
        $mailer->setFrom(['me@example.com' => 'My Site'])
               ->setTo('you@example.com')
               ->setSubject('About');
        //default template
        //templates/email/text/confirm.php
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
