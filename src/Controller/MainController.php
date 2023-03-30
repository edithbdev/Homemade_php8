<?php

namespace Controller;

use Model\Creator;
use Service\View;

/**
 * Main Controller
 *
 */
class MainController extends BaseController
{
    /**
     * Gérer la page d'accueil (main_home route)
     *
     * @return void
     */
    public function index()
    {
        $creators = Creator::findLasts();

        return View::returnTemplate('main/index', [
            'creators' => $creators
        ]);
    }
}