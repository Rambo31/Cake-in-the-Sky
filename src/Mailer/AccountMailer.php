<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;
use App\Model\Entity\Account;

class AccountMailer extends Mailer
{
    public function confirm(Account $account): void{
        //I need account object here to access an email
        $this->setTransport('gmail')
             ->setEmailFormat('html')
         //droped 'from' as they say gmail checks if I actually control the domain
             ->setFrom(['reg@cakeinthesky.com' => 'Cake in the Sky Project (No Reply)'])
         //change to account's email when go IRL
             ->setTo( env('MY_EMAIL_FOR_TESTING', false) )
             ->setSubject('Confirm New Account');
    }
}
