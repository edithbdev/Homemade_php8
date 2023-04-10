<?php

namespace App\Tests\Unit\Model;

use App\Model\Creator;
use App\Model\Category;
use PHPUnit\Framework\TestCase;

class CreatorTest extends TestCase
{
    public function testCreator(): void
    {
        $creator = new Creator();
        $creator->setId(1);
        $creator->setLastname('Doe');
        $creator->setFirstname('John');
        $creator->setBrand('JD');
        $creator->setPhoto('photo.jpg');

        $this->assertSame(1, $creator->getId());
        $this->assertSame('Doe', $creator->getLastname());
        $this->assertSame('John', $creator->getFirstname());
        $this->assertSame('John Doe', $creator->getFullName());
        $this->assertSame('JD', $creator->getBrand());
        $this->assertSame('photo.jpg', $creator->getPhoto());
    }

    public function testGetCategories(): void
    {
        $creator = new Creator();
        $category = new Category();
        $category->setId(1);
        $category->setName('Category 1');

        $creator->addCategory($category);

        $this->assertSame(1, $creator->getCategories()[0]->getId());
        $this->assertSame('Category 1', $creator->getCategories()[0]->getName());
    }
}

