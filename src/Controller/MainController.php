<?php

namespace App\Controller;

use App\Model\Creator;
use App\Service\View;

/**
 * Main Controller
 *
 */
class MainController extends BaseController
{
    /**
     * Gérer la page d'accueil (main_home route)
     *
     * @return string|false
     */
    public function index(): string|false
    {
        $creators = Creator::findLasts();

        return View::returnTemplate('main/index', [
            'creators' => $creators,
        ]);
    }
}