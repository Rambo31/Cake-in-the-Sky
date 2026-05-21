<?php
namespace App\Test\TestCase\Mailer;

use App\Mailer\AccountMailer;
use App\Model\Entity\Account;

use Cake\TestSuite\EmailTrait;
use Cake\TestSuite\TestCase;

class AccountMailerTestCase extends TestCase
{
    use EmailTrait;

    //this thing is needed if URLs are generated
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRoutes();
    }

    public function testName()
    {
        $mailer = new AccountMailer();
        $mailer->send('confirm');

        $this->assertMailSentTo('you@example.com');
        $this->assertMailContainsText('Hello world!');
        $this->assertMailContainsText('Welcome to CakePHP!');
    }
}
