<?php
// Chargement des classes automatiquement avec Composer (autoload)
require __DIR__ . '/../vendor/autoload.php';

// Chargement des variables d'environnement
use Dotenv\Dotenv;

   // Ajouter le fichier .env.dev
   $dotenv = Dotenv::createImmutable(__DIR__, '/../.env.dev');
   $dotenv->load();

use App\Service\Router;

   // Démarre la session si elle n'est pas déjà démarrée
   ob_start();
   // si la session n'est pas démarrée, on la démarre
   if(!isset($_SESSION)) {
       session_start();
   }

$router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

try {
    $result = $router->dispatch();
} catch (\Throwable $th) {
    if (get_class($th) === "Exception") {
        var_dump($th);
    }
    if (get_class($th) === "Error") {
        var_dump($th);
        die;
    }
}

header('Content-Type: text/html');
echo $result;