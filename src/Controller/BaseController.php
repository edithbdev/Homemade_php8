<?php

namespace Controller;

use Service\Router;

/**
 * Gestion des redirections de l'application
 */
class BaseController
{
    protected function redirect($routeName, $routeParams = [])
    {
        header('location:' . Router::generate($routeName, $routeParams));
        die();
    }
}