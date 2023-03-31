<?php

namespace Controller\User;

use Controller\BaseController;

/**
 * Logout Controller
 *
 */
class LogoutController extends BaseController
{
    /**
     * Gérer la page de déconnexion (user_logout route)
     * 
     * @return void
     */
    public function logout()
    {
        //on supprime l'utilisateur de la session
        unset($_SESSION['user']);
        $this->redirect('main_index');
    }
}