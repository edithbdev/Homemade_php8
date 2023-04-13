<?php

namespace App\Controller\Creator;

use App\Model\Creator;
use App\Service\View;
use App\Controller\BaseController;

/**
 * Creator Controller
 *
 */
class CreatorIndexController extends BaseController
{
    /**
     * Gérer la page d'accueil (creator_creators route)
     *
     * @return string|false
     */
    public function index(): string|false
    {
        $creators = Creator::findAll();

        // dd($creators);

        return View::returnTemplate('creator/creators', [
            'creators' => $creators,
        ]);
    }
}
