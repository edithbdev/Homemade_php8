<?php

namespace App\Tests\Unit\Service;

use App\Service\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testDispatch(): void
    {
        $router = new Router('/login', 'GET');
        $result = $router->dispatch();
        $this->assertIsString($result);
        $this->assertStringContainsString('Se connecter', $result);

        $router = new Router('/register', 'GET');
        $result = $router->dispatch();
        $this->assertIsString($result);
        $this->assertStringContainsString('S\'inscrire', $result);

        $router = new Router('/forgotPassword', 'GET');
        $result = $router->dispatch();
        $this->assertIsString($result);
        $this->assertStringContainsString('Email', $result);

        $router = new Router('/notFound', 'GET');
        $result = $router->dispatch();
        $this->assertIsString($result);
        $this->assertStringContainsString('404', $result);
    }

    public function testGenerate(): void
    {
        $router = new Router('/login', 'GET');
        $result = $router->generate('user_login');
        $this->assertIsString($result);
        $this->assertEquals('/login', $result);

        $router = new Router('/register', 'GET');
        $result = $router->generate('user_register');
        $this->assertIsString($result);
        $this->assertEquals('/register', $result);

        $router = new Router('/forgotPassword', 'GET');
        $result = $router->generate('user_forgotPassword');
        $this->assertIsString($result);
        $this->assertEquals('/forgotPassword', $result);
    }
}
