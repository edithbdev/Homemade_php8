<?php

namespace App\Controller\User;

use App\Model\User;
use App\Service\View;
use App\Controller\BaseController;

/**
 * ResetPassword Controller 
 *
 */
class ResetPasswordController extends BaseController
{
    /**
     * Gérer la page de réinitialisation du mot de passe (user_resetPassword route)
     * 
     * @return string|false
     */
    public function resetPassword(): string|false
    {

        $token = $_GET['token'];
        $errors = [];

        if (!empty($_POST)) {
            $errors = $this->validateResetPasswordForm();
            if (empty($errors)) {
                //on récupère les données saisies par l'utilisateur dans le formulaire
                $password = isset($_POST['password_resetPassword']) ? $_POST['password_resetPassword'] : null;
                $passwordConfirm = isset($_POST['passwordConfirm_resetPassword']) ? $_POST['passwordConfirm_resetPassword'] : null;

                // on vérifie que l'utilisateur existe en base de données
                $user = User::resetPassword($token, $password);

                if ($user) {
                    $this->redirect('user_login');
                }
            } 
        }

        return View::returnTemplate('user/resetPassword', [
            'errors' => $errors ? $errors : [],
            'password_resetPassword' => isset($password) ? $password : '',
            'passwordConfirm_resetPassword' => isset($passwordConfirm) ? $passwordConfirm : ''
        ]);
    }

    /**
     * Validate ResetPassword form
     * 
     * @return array<string>
     */
    private function validateResetPasswordForm(): array
    {
        $errors = [];

        if (isset($_POST['password_resetPassword'])) {
            if (empty($_POST['password_resetPassword'])) {
                $errors['password_resetPassword'] = 'Veuillez renseigner votre mot de passe';
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d$@$!%*#?&]{8,}$/', $_POST['password_resetPassword'])) {
                $errors['password_resetPassword'] = 'Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre';
            }
        }

        if (isset($_POST['passwordConfirm_resetPassword'])) {
            if (empty($_POST['passwordConfirm_resetPassword'])) {
                $errors['passwordConfirm_resetPassword'] = 'Veuillez confirmer votre mot de passe';
            } elseif ($_POST['password_resetPassword'] !== $_POST['passwordConfirm_resetPassword']) {
                $errors['passwordConfirm_resetPassword'] = 'Les mots de passe ne correspondent pas';
            }
        }

        return $errors;
    }
}
