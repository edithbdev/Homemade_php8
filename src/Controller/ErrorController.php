<?php

namespace Controller;

use Service\View;

/**
 * Gestion des erreurs de l'application
 *
 */
class ErrorController extends BaseController
{
    /**
     * Methode pour gérer les erreurs 404
     *
     * @return void
     */
    public function error404()
    {
        header("HTTP/1.1 404 Not Found");
        return View::returnTemplate('error/error404');
    }
}