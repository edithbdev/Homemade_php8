<?php

namespace Controller\User;

use Model\User;
use Service\View;
use Controller\BaseController;

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

        $result = User::activateAccount($token);

       

        $this->redirect('user_login');

        return View::returnTemplate('user/emailConfirmation', [
            'result' => $result ?? false
        ]);
    }  
}
