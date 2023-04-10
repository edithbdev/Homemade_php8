<?php

namespace App\Controller\User;

use App\Model\User;
use App\Service\View;
use App\Controller\BaseController;

/**
 * User Controller
 *
 */
class LoginController extends BaseController
{
    /**
     * Gérer la page de connexion (user_login route)
     * 
     * @return string|false
     */
    public function login(): string|false
    {
        $email = "";
        $errors = [];

        $generateUrlForgetPassword = View::generateUrl('user_forgotPassword');
        $generateUrlRegister = View::generateUrl('user_register');

        if (!empty($_POST)) {
            $errors = $this->validateLoginForm();
            if (empty($errors)) {
                //on récupère les données saisies par l'utilisateur dans le formulaire
                $email = isset($_POST['email_login']) ? $_POST['email_login'] : null;
                $password = isset($_POST['password_login']) ? $_POST['password_login'] : null;

                // on vérifie que l'utilisateur existe en base de données
                $user = User::login($email, $password);

                if ($user) {
                    //on redirige l'utilisateur vers la page d'accueil
                    $this->redirect('main_index');
                }
            } else {
                //on stocke les données saisies par l'utilisateur en cas d'erreur
                $email = $_POST['email_login'];
            }
        }

        return View::returnTemplate('user/login', [
            'generateUrlForgetPassword' => $generateUrlForgetPassword,
            'generateUrlRegister' => $generateUrlRegister,
            'errors' => $errors ? $errors : [],
            'email' => $email ? $email : ''
        ]);
    }

    /**
     * Validate login form
     * 
     * @return array<string>
     */
    private function validateLoginForm(): array
    {
        $errors = [];

        if (isset($_POST['email_login'])) {
            if (empty($_POST['email_login'])) {
                $errors['email_login'] = 'L\'email est obligatoire';
            } else {
                //on vérifie que l'email est valide
                if (!filter_var($_POST['email_login'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email_login'] = 'L\'email n\'est pas valide';
                }
            }
        }

        if (isset($_POST['password_login'])) {
            if (empty($_POST['password_login'])) {
                $errors['password_login'] = 'Le mot de passe est obligatoire';
            }
        }

        return $errors;
    }
}
