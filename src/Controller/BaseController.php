<?php

namespace App\Controller;

use App\Service\Router;

/**
 * Gestion des redirections de l'application
 */
class BaseController
{
    /**
     * Redirige vers une route
     *
     * @param string $routeName
     * @param array<string, string> $routeParams
     * @return void
     */

    protected function redirect(string $routeName, array $routeParams = []): void
    {
        header('location:' . Router::generate($routeName, $routeParams));
        die();
    }
}