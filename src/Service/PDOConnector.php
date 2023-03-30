<?php

namespace Service;

use PDO;
use Exception;
use PDOException;

/**
 * Singleton pour gérer la connexion à la base de données à l'aide de PDO
 */
class PDOConnector
{

    /**
     * L'instance singleton
     *
     * @var PDOConnector
     */
    private static $instance = null;

    /**
     * Object PDO
     *
     * @var PDO
     */
    private $connection;

    /**
     * Créer une connexion PDO à la base de données
     */
    private function __construct()
    {
        define('DATABASE_USER', $_ENV['DATABASE_USER']);
        define('DATABASE_ROOT_PASSWORD', $_ENV['DATABASE_ROOT_PASSWORD']);
        define('DATABASE_HOST', $_ENV['DATABASE_HOST']);
        define('DATABASE_NAME', $_ENV['DATABASE_NAME']);

        try {
            $this->connection = new PDO(
                "mysql:host=" . DATABASE_HOST . ";dbname=" . DATABASE_NAME . "",
                DATABASE_USER,
                DATABASE_ROOT_PASSWORD,
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Renvoie une instance de sa classe (modèle de conception singleton)
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new PDOCOnnector();
        }
        return self::$instance;
    }

    /**
     * Exécuter une requête sur la connexion PDO
     *
     * @param string $query la query à exécuter
     * @param array $args paramètres de requête facultatifs
     */
    public function query($query, array $args = [])
    {
        if ($args !== []) {
            $sth = $this->connection->prepare($query);
            $sth->execute($args);
            if ($sth->errorInfo()[0] != '00000') {
                throw new Exception($sth->errorInfo()[1], $sth->errorInfo()[0]);
            }
            return $this->connection->lastInsertId() !== "0" ? [$sth, $this->connection->lastInsertId()] : [$sth];
        } else {
            return $this->connection->query($query);
        }
    }
}