<?php

namespace App\Controller\User;

use App\Model\User;
use App\Service\View;
use App\Controller\BaseController;

/**
 * ForgotPassword Controller 
 *
 */
class ForgotPasswordController extends BaseController
{
    /**
     * Gérer la page de mot de passe oublié (user_forgotPassword route)
     * 
     * @return string|false
     */
    public function forgotPassword(): string|false
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
                'errors' => $errors ? $errors : [],
                'email' => $email ?? ''
            ]);
        }

        /**
         * Validate ForgotPassword form
         * 
         * @return array <string, string> $errors
         */
        private function validateForgotPasswordForm(): array
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
