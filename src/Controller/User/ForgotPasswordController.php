<?php

namespace Controller\User;

use Model\User;
use Service\View;
use Controller\BaseController;

/**
 * ForgotPassword Controller 
 *
 */
class ForgotPasswordController extends BaseController
{
    /**
     * Gérer la page de mot de passe oublié (user_forgotPassword route)
     * 
     * @return void
     */
    public function forgotPassword()
    {
            $errors = [];
    
            if (!empty($_POST)) {
                $errors = $this->validateForgotPasswordForm();
                if (empty($errors)) {
                    //on récupère les données saisies par l'utilisateur dans le formulaire
                    $email = isset($_POST['email_forgotPassword']) ? $_POST['email_forgotPassword'] : null;
    
                    // on vérifie que l'utilisateur existe en base de données
                    User::forgotPassword($email);
                } 
            } 

            return View::returnTemplate('user/forgotPassword', [
                'errors' => $errors ?? [],
                'email' => $email ?? ''
            ]);
        }

        /**
         * Validate ForgotPassword form
         * 
         * @return array
         */
        private function validateForgotPasswordForm()
        {
            $errors = [];
    
            if (isset($_POST['email_forgotPassword'])) {
                if (empty($_POST['email_forgotPassword'])) {
                    $errors['email_forgotPassword'] = 'Veuillez renseigner votre email';
                } elseif (!filter_var($_POST['email_forgotPassword'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email_forgotPassword'] = 'Veuillez renseigner un email valide';
                }
            }
    
            return $errors;
        }
}
