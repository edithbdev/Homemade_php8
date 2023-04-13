<?php

namespace App\Controller;

use App\Service\View;
use App\Controller\BaseController;

/**
 * Gestion des erreurs de l'application
 *
 */
class ErrorController extends BaseController
{
    /**
     * Methode pour gérer les erreurs 404
     *
     * @return string|false
     */
    public function error404(): string|false
    {
        header("HTTP/1.1 404 Not Found");
        return View::returnTemplate('error/error404');
    }
}