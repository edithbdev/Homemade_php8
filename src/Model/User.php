<?php

namespace Model;

use Exception;
use Service\PDOConnector;
use Service\SendMail;

/**
 * Model User
 *
 * Cette classe représente un utilisateur
 * Contient les propriétés et méthodes
 */

class User
{
    /**
     * User lastname
     *
     * @var string
     */
    protected $lastname;

    /**
     * User firstname
     *
     * @var string
     */
    protected $firstname;

    /**
     * User email
     *
     * @var string
     */
    protected $email;

    /**
     * User password
     *
     * @var string
     */
    protected $password;

    /**
     * User password_confirm
     *
     * @var string
     */
    protected $password_confirm;

    /**
     * User token
     *
     * @var string
     */
    protected $token;

    /**
     * User role
     *
     * @var string
     */
    protected $role;

    /**
     * User is_active
     *
     * @var boolean
     */
    protected $is_active;

    /**
     * User created_at
     *
     * @var string
     */
    protected $created_at;

    /**
     * User updated_at
     *
     * @var string
     */
    protected $updated_at;

    /**
     * User deleted_at
     *
     * @var string
     */
    protected $deleted_at;

    /**
     * Creator
     * 
     * @var Creator
     */
    protected $creator;

    /**
     * Get creator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set creator
     *
     * @return  self
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * id
     * @var int
     */
    protected $id;

    /**
     * Get id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @return  self
     */

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password_confirm
     */
    public function getPassword_confirm()
    {
        return $this->password_confirm;
    }

    /**
     * Set password_confirm
     *
     * @return  self
     */
    public function setPassword_confirm($password_confirm)
    {
        $this->password_confirm = $password_confirm;

        return $this;
    }

    /**
     * Get token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get is_active
     */
    public function getIs_active()
    {
        return $this->is_active;
    }

    /**
     * Set is_active
     *
     * @return  self
     */
    public function setIs_active($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * Get created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get deleted_at
     */
    public function getDeleted_at()
    {
        return $this->deleted_at;
    }

    /**
     * Set deleted_at
     *
     * @return  self
     */
    public function setDeleted_at($deleted_at)
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * Validate all properties and throw an exception
     *
     * @return bool
     * @throws Exception
     */
    private function propertyValidation()
    {
        if(empty($this->lastname)) {
            throw new Exception('Le nom est obligatoire');
        }
        if(empty($this->firstname)) {
            throw new Exception('Le prénom est obligatoire');
        }
        if(empty($this->email)) {
            throw new Exception('L\'email est obligatoire');
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('L\'email n\'est pas valide');
        }
        if(self::emailExists($this->email)) {
            throw new Exception('L\'email existe déjà');
        }
        if(empty($this->password)) {
            throw new Exception('Le mot de passe est obligatoire');
        }
        if(empty($this->password_confirm)) {
            throw new Exception('La confirmation du mot de passe est obligatoire');
        }
        if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d$@$!%*#?&]{8,}$/', $_POST['password'])) {
            throw new Exception('Le mot de passe doit faire au moins 8 caractères et contenir au moins une majuscule, une minuscule et un chiffre');
        }
        if($this->password != $this->password_confirm) {
            throw new Exception('Les mots de passe ne correspondent pas');
        }
        return true;
    }

    /**
     * Login user
     * 
     * @return boolean
     */
    public static function login($email, $password)
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM user WHERE email = "' . $email . '"');
        $fetchUser = $request->fetchObject(self::class);
        if ($fetchUser) {
            //on vérifie que le mot de passe est correct et qu'il a validé son compte
            if (password_verify($password, $fetchUser->getPassword()) && $fetchUser->getIs_active() == 1) {
                $_SESSION['user'] = $fetchUser;
                return true;
            } else {
                $_SESSION['error'] = 'Vous n\'avez pas validé votre compte ou le mot de passe est incorrect !';
                return false;
            }
        } else {
            $_SESSION['error'] = 'L\'email ou le mot de passe est incorrect';
            return false;
        }
    }

    /**
     * On vérifie si l'email existe déjà
     * 
     * @param string $email
     */
    public static function emailExists($email)
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM user WHERE email = "' . $email . '"');
        $fetchUser = $request->fetchObject(self::class);
        if ($fetchUser) {
            return true;
        }
    }

    /**
     * Récupérér un user par son id
     * 
     * @param int $id
     */
    public static function find($id)
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM user WHERE id = ' . $id);
        $fetchUser = $request->fetchObject(self::class);
        return $fetchUser;
    }

    /**
     * Insertion d'un user
     * 
     * @return boolean
     */
    public function insert()
    {
        $this->propertyValidation();
        $pdo = PDOConnector::getInstance();
        $password = (string)$this->password;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->token = bin2hex(random_bytes(32));
        $this->role = 'user';
        $this->is_active = 0;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
        $this->deleted_at = null;

        $request = $pdo->query(
            'INSERT INTO user (lastname, firstname, email, password, token, role, is_active, created_at, updated_at, deleted_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)', [
                $this->lastname,
                $this->firstname,
                $this->email,
                $this->password,
                $this->token,
                $this->role,
                $this->is_active,
                $this->created_at,
                $this->updated_at,
                $this->deleted_at
            ]
        );

        $user_id = $request[1];

        if ($request) {
            //on récupère l'id de l'utilisateur inséré
            $this->id = $user_id;
            $confirmationUrl = 'http://localhost:8888/emailConfirmation?token=' . $this->token;
            $sendEmail = new SendMail();
            $sendEmail->send(
                $this->email,
                'Confirmation de votre compte',
                'Bonjour ' . $this->firstname . ' ' . $this->lastname . ',<br><br>
                Merci pour votre inscription !, merci de cliquer sur le lien suivant pour activer votre compte :<br><br>
                <a href="' . $confirmationUrl . '"> Activer mon compte </a>
                <br><br>
                L\'équipe de Homemade'

            );
            $_SESSION['success'] = 'Votre compte a bien été créé, un email de confirmation vous a été envoyé';
            return true;
        } else {
            $_SESSION['error'] = 'Une erreur est survenue, veuillez réessayer ultérieurement';
            return false;
        }
    }

    /**
     * Activation du compte utilisateur
     * 
     * @param string $token Token d'activation du compte
     * @return boolean
     */
    public static function activateAccount($token)
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query("UPDATE user SET is_active = 1 WHERE token = ?", [$token]);
            if ($request) {
                    $_SESSION['success'] = 'Votre compte a bien été activé, vous pouvez vous connecter';
                    return true;
            } else {
                $_SESSION['error'] = 'Une erreur est survenue, veuillez réessayer ultérieurement';
                return false;
            }
    }

    /**
     * Oubli du mot de passe
     * 
     * @param string $email Email de l'utilisateur
     * @return boolean
     */
    public static function forgotPassword($email)
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM user WHERE email = "' . $email . '"');
        $fetchUser = $request->fetchObject(self::class);
        if ($fetchUser) {
            $resetPasswordUrl = 'http://localhost:8888/resetPassword?token=' . $fetchUser->getToken();
            $sendEmail = new SendMail();
            $sendEmail->send(
                $fetchUser->getEmail(),
                'Réinitialisation de votre mot de passe',
                'Bonjour ' . $fetchUser->getFirstname() . ' ' . $fetchUser->getLastname() . ',<br><br>
                Vous avez demandé à réinitialiser votre mot de passe, merci de cliquer sur le lien suivant pour le faire :<br><br>
                <a href="' . $resetPasswordUrl . '"> Réinitialiser mon mot de passe </a>
                <br><br>
                L\'équipe de Homemade'
            );
            $_SESSION['success'] = 'Un email vous a été envoyé pour réinitialiser votre mot de passe';
            return true;
        } else {
            $_SESSION['error'] = 'L\'email n\'existe pas';
            return false;
        }
    }

    /**
     * Réinitialisation du mot de passe
     * 
     * @param string $token Token de réinitialisation du mot de passe
     * @param string $password Nouveau mot de passe
     * @return boolean
     */
    public static function resetPassword($token, $password)
    {
        $pdo = PDOConnector::getInstance();
        $password = (string)$password;
        $password = password_hash($password, PASSWORD_BCRYPT);
        $request = $pdo->query("UPDATE user SET password = ? WHERE token = ?", [$password, $token]);
        if ($request) {
            $_SESSION['success'] = 'Votre mot de passe a bien été réinitialisé, vous pouvez vous connecter';
            return true;
        } else {
            $_SESSION['error'] = 'Une erreur est survenue, veuillez réessayer ultérieurement';
            return false;
        }
    }
}