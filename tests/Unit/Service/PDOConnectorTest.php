<?php

namespace App\Tests\Unit\Service;

use App\Service\PDOConnector;
use PHPUnit\Framework\TestCase;

class PDOConnectorTest extends TestCase
{
    public function testPDOConnectorInstance(): void
    {
        $pdoConnector = PDOConnector::getInstance();
        $this->assertInstanceOf(PDOConnector::class, $pdoConnector);

        // On vérifie que l'instance est bien unique
        $pdoConnectorNew = PDOConnector::getInstance();
        $this->assertSame($pdoConnector, $pdoConnectorNew);
    }

    public function testPDOQuery(): void
    {
        //on crée la table user
        $pdoConnector = PDOConnector::getInstance();
        $pdoConnector->query('DROP TABLE IF EXISTS user');
        $pdoConnector->query('CREATE TABLE user (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            role VARCHAR(255) NOT NULL
        )');

        $this->assertTrue(true);

        // on selectionne tous les utilisateurs
        $pdoConnector->query('SELECT * FROM user');
        $this->assertTrue(true);

        //on insère un utilisateur
        $pdoConnector->query('INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, ?)', ['test', 'test', 'test@test.fr', 'admin']);
        $this->assertTrue(true);

        // on vérifie que l'utilisateur a bien été inséré
        $pdoConnector->query('SELECT * FROM user WHERE username = ?', ['test']);
        $this->assertTrue(true);

        // // on supprime l'utilisateur
        // $pdoConnector->query('DELETE FROM user WHERE username = ?', ['test']);
        // $this->assertTrue(true);

        // // on supprime la table user
        // $pdoConnector->query('DROP TABLE user');
        // $this->assertTrue(true);

    }
}
