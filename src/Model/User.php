<?php

namespace App\Model;

use App\Service\PDOConnector;
use App\Service\SendMail;
use Exception;

/**
 * User Model
 *
 * Cette classe représente un utilisateur
 * Contient les propriétés et méthodes
 */

class User
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $password_confirm;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $role;

    /**
     * @var int
     */
    protected $is_active;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $updated_at;

    /**
     * @var string|null
     */
    protected $deleted_at;

    /**
     * @var Creator
     */
    protected Creator $creator;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return self
     */
    public function setLastname($lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return self
     */
    public function setFirstname($firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return self
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword_confirm(): string
    {
        return $this->password_confirm;
    }

    /**
     * @param string $password_confirm
     * @return self
     */
    public function setPassword_confirm($password_confirm): self
    {
        $this->password_confirm = $password_confirm;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return self
     */
    public function setToken($token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return self
     */
    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return int
     */
    public function getIs_active(): int
    {
        return $this->is_active;
    }

    /**
     * @param int $is_active
     * @return self
     */
    public function setIs_active($is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return self
     */
    public function setCreated_at($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdated_at(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     * @return self
     */
    public function setUpdated_at($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeleted_at(): ?string
    {
        return $this->deleted_at;
    }

    /**
     * @param string $deleted_at
     * @return  self
     */
    public function setDeleted_at($deleted_at): self
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * @return Creator
     */
    public function getCreator(): Creator
    {
        return $this->creator;
    }

    /**
     * @param Creator $creator
     * @return self
     */
    public function setCreator($creator): self
    {
        $this->creator = $creator;

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
        if (empty($this->lastname)) {
            throw new Exception('Le nom est obligatoire');
        }
        if (empty($this->firstname)) {
            throw new Exception('Le prénom est obligatoire');
        }
        if (empty($this->email)) {
            throw new Exception('L\'email est obligatoire');
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('L\'email n\'est pas valide');
        }
        if (self::emailExists($this->email)) {
            throw new Exception('L\'email existe déjà');
        }
        if (empty($this->password)) {
            throw new Exception('Le mot de passe est obligatoire');
        }
        if (empty($this->password_confirm)) {
            throw new Exception('La confirmation du mot de passe est obligatoire');
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d$@$!%*#?&]{8,}$/', $_POST['password'])) {
            throw new Exception('Le mot de passe doit faire au moins 8 caractères et contenir au moins une majuscule, une minuscule et un chiffre');
        }
        if ($this->password != $this->password_confirm) {
            throw new Exception('Les mots de passe ne correspondent pas');
        }
        return true;
    }

    /**
     * Login user
     *
     * @param string $email
     * @param string $password
     *
     * @return boolean
     */
    public static function login($email, $password): bool
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
     *
     * @return boolean
     */
    public static function emailExists($email): bool
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM user WHERE email = "' . $email . '"');
        $fetchUser = $request->fetchObject(self::class);
        if ($fetchUser) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Récupérér un user par son id
     *
     * @param int $id
     *
     * @return User
     */
    public static function find($id): User
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
    public function insert(): bool
    {
        $this->propertyValidation();
        $pdo = PDOConnector::getInstance();
        $password = (string) $this->password;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->token = bin2hex(random_bytes(32));
        $this->role = 'user';
        $this->is_active = 0;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
        $this->deleted_at = null;

        $request = $pdo->query(
            'INSERT INTO user (lastname, firstname, email, password, token, role, is_active, created_at, updated_at, deleted_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)', [
                $this->lastname,
                $this->firstname,
                $this->email,
                $this->password,
                $this->token,
                $this->role,
                $this->is_active,
                $this->created_at,
                $this->updated_at,
                $this->deleted_at,
            ]
        );

        $user_id = $request[1];

        if ($request) {
            //on récupère l'id de l'utilisateur inséré
            $this->id = $user_id;
            //on envoie un email de confirmation
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
    public static function activateAccount($token): bool
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
    public static function forgotPassword($email): bool
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
    public static function resetPassword($token, $password): bool
    {
        $pdo = PDOConnector::getInstance();
        $password = (string) $password;
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