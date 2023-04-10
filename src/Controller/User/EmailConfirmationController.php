<?php

namespace App\Controller\User;

use App\Model\User;
use App\Controller\BaseController;

/**
 * EmailConfirmation Controller
 *
 */
class EmailConfirmationController extends BaseController
{
    /**
     * Gérer l'activation du compte (user_emailConfirmation route)'
     *
     * @return void
     */
    public function emailConfirmation()
    {
        $token = $_GET['token'];

        User::activateAccount($token);

        $this->redirect('user_login');
    }  
}
