<?php

namespace App\Tests\Unit\Model;

use App\Model\Creator;
use App\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetFullName(): void
    {
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');

        $this->assertSame('John Doe', $user->getFullName());
    }

    public function testGetCreator(): void
    {
        $user = new User();
        $creator = new Creator();
        $creator->setId(1);
        $creator->setLastname('Doe');
        $creator->setFirstname('John');
        $creator->setBrand('JD');
        $creator->setPhoto('photo.jpg');

        $user->setCreator($creator);

        $this->assertSame(1, $user->getCreator()->getId());
        $this->assertSame('Doe', $user->getCreator()->getLastname());
        $this->assertSame('John', $user->getCreator()->getFirstname());
        $this->assertSame('John Doe', $user->getCreator()->getFullName());
        $this->assertSame('JD', $user->getCreator()->getBrand());
        $this->assertSame('photo.jpg', $user->getCreator()->getPhoto());
    }
}