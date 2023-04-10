<?php

namespace App\Tests\Unit\Service;

use App\Service\SendMail;
use PHPUnit\Framework\TestCase;


class SendMailTest extends TestCase
{
    public function testSendMail(): void
    {
        $sendMail = new SendMail();
        $result = $sendMail->send('toto@test.com', 'test', 'test');
        $this->assertTrue(is_bool($result));
        $this->assertTrue($result);
    }
}
