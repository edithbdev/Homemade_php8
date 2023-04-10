<?php

namespace App\Controller\User;

use App\Model\User;
use App\Service\View;
use App\Controller\BaseController;

/**
 * Register Controller
 *
 */
class RegisterController extends BaseController
{
    /**
     * Gérer la page d'inscription (user_register route)
     * 
     * @return string|false
     */
    public function register(): string|false
    {
        $lastname = $firstname = $email = "";
        $errors = [];
         //on génère l'url de la page de connexion
         $generateUrlLogin = View::generateUrl('user_login');

        // on vérifie que le formulaire a été soumis
        if (!empty($_POST)) {
            //on valide le formulaire et on récupère les erreurs
            $errors = $this->validateRegisterForm();
            //si il n'y a pas d'erreurs on insère l'utilisateur en base de données
            if (empty($errors) && isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
                $user = new User();
                $user->setLastname($_POST['lastname']);
                $user->setFirstname($_POST['firstname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setPassword_confirm($_POST['password_confirm']);
                $user->setRole('user');
                $user->setCreated_at(date('Y-m-d H:i:s'));
                $user->insert();

                $this->redirect('user_login');
            } else {
                //on stocke les données saisies par l'utilisateur en cas d'erreur
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
            }
        }

        return View::returnTemplate('user/register', [
            'generateUrlLogin' => $generateUrlLogin ? $generateUrlLogin : '',
            'errors' => $errors ? $errors : [],
            'lastname' => $lastname ? $lastname : '',
            'firstname' => $firstname ? $firstname : '',
            'email' => $email ? $email : ''
        ]);
    }

    /**
     * Validation du formulaire d'inscription
     * 
     * @return array<string>
     */
    private function validateRegisterForm(): array
    {
        $errors = [];

        if (isset($_POST['lastname'])) {
            if (empty($_POST['lastname'])) {
                $errors['lastname'] = 'Le nom est obligatoire';
            }
        }

        if (isset($_POST['firstname'])) {
            if (empty($_POST['firstname'])) {
                $errors['firstname'] = 'Le prénom est obligatoire';
            }
        }

        if (isset($_POST['email'])) {
            if (empty($_POST['email'])) {
                $errors['email'] = 'L\'email est obligatoire';
            } else {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'L\'email n\'est pas valide';
                } else {
                    $user = User::emailExists($_POST['email']);
                    if ($user) {
                        $errors['email'] = 'Cet email est déjà utilisé';
                    }
                }
            }
        }

        if (isset($_POST['password'])) {
            if (empty($_POST['password'])) {
                $errors['password'] = 'Le mot de passe est obligatoire';
            } else {
                if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d$@$!%*#?&]{8,}$/', $_POST['password'])) {
                    $errors['password'] = 'Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre';
                }
            }
        }

        if (isset($_POST['password_confirm'])) {
            if (empty($_POST['password_confirm'])) {
                $errors['password_confirm'] = 'La confirmation du mot de passe est obligatoire';
            } else {
                if ($_POST['password_confirm'] != $_POST['password']) {
                    $errors['password_confirm'] = 'La confirmation du mot de passe ne correspond pas';
                }
            }
        }
        return $errors;
    }
}
