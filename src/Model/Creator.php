<?php

namespace App\Model;

use PDO;
use Exception;
use App\Service\PDOConnector;

/**
 * Creator Model 
 *
 * Cette classe représente un créateur
 * Contient les propriétés et méthodes
 */

class Creator
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
    protected $brand;

    /**
     * @var string
     */
    protected $photo;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var string
     */
    protected $site_perso;

    /**
     * @var string
     */
    protected $link_fb;

    /**
     * @var string
     */
    protected $link_insta;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $status;

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
     * @var array<\App\Model\Category>
     */
    protected $categories = [];

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
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return self
     */
    public function setBrand($brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return self
     */
    public function setPhoto($photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return self
     */
    public function setImage($image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getSite_perso(): string
    {
        return $this->site_perso;
    }

    /**
     * @param string $site_perso
     * @return self
     */
    public function setSite_perso($site_perso): self
    {
        $this->site_perso = $site_perso;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink_fb(): string
    {
        return $this->link_fb;
    }

    /**
     * @param string $link_fb
     * @return self
     */
    public function setLink_fb($link_fb): self
    {
        $this->link_fb = $link_fb;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink_insta(): string
    {
        return $this->link_insta;
    }

    /**
     * @param string $link_insta
     * @return self
     */
    public function setLink_insta($link_insta): self
    {
        $this->link_insta = $link_insta;
        return $this;
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
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return self
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return self
     */
    public function setStatus($status): self
    {
        $this->status = $status;
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
     * @return self
     */
    public function setDeleted_at($deleted_at): self
    {
        $this->deleted_at = $deleted_at;
        return $this;
    }
    
    /**
     * @return array<mixed>
     */
    public function getCategories(): array
    {
        return (array) $this->categories; 
    }

    /**
     * @param array<mixed> $categories
     * @return self
     */
    public function setCategories($categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * On ajoute une catégorie à la liste des catégories du créateur
     * 
     * @param Category $category
     * 
     * @return self
     */
    public function addCategory(Category $category): self
    {
        $this->categories[] = $category;
        return $this;
    }

    /**
     * On récupère les données d'un créateur en fonction de son id
     * 
     * @param int $id
     * 
     * @return Creator|false
     */
    public static function find(int $id): Creator|false
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM creator WHERE id = ?', [$id]);
        return $request->fetchObject(self::class);
    }

    /**
     * On récupère toutes les données de la table creator
     *
     * @return array<mixed>
     */
    public static function findAll(): array
    {
        $pdo = PDOConnector::getInstance();
        //on récupère les données de la table creator
        $request = $pdo->query('SELECT * FROM creator');
        return $request->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * On récupère les 3 derniers créateurs inscrits et validés + leurs catégories
     *
     * @return array<mixed>
     */
    public static function findLasts(): array
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query("
            SELECT creator.*, GROUP_CONCAT(category.name) AS categories
            FROM creator
            JOIN category_creator ON creator.id = category_creator.id_creator
            JOIN category ON category_creator.id_category = category.id
            WHERE creator.status = 'validated'
            GROUP BY creator.id
            ORDER BY creator.created_at DESC
            LIMIT 3
        "
        );
        
        return $request->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Insert un nouveau créateur dans la table creator
     * 
     * @return bool
     */
    public function insert(): bool
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query(
            'INSERT INTO creator (lastname, firstname, site_perso, link_fb, link_insta, email, phone, image, description, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $this->lastname, 
                $this->firstname, 
                $this->site_perso, 
                $this->link_fb, 
                $this->link_insta, 
                $this->email, 
                $this->phone, 
                $this->image,
                $this->description, 
                $this->status, 
                $this->created_at = date('Y-m-d H:i:s'),
                $this->updated_at = date('Y-m-d H:i:s')
            ]);
            $creator_id = $request[1]; 
            foreach($this->categories as $category) {
                $request = $pdo->query(
                    'INSERT INTO category_creator (category_id, creator_id) VALUES (?, ?)', [
                        $category,
                        $creator_id
                    ]);
            }
            $this->id = $creator_id;

            return true;
    }

    /**
     * Update un créateur dans la table creator
     *
     * @return bool
     */
    public function update(): bool
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query(
            'UPDATE creator SET lastname = ?, firstname = ?, site_perso = ?, link_fb = ?, link_insta = ?, email = ?, phone = ?, image = ?, description = ?, status = ?, updated_at = ? WHERE id = ?', [
                $this->lastname, 
                $this->firstname, 
                $this->site_perso, 
                $this->link_fb, 
                $this->link_insta, 
                $this->email, 
                $this->phone, 
                $this->image,
                $this->description, 
                $this->status, 
                $this->updated_at = date('Y-m-d H:i:s'),
                $this->id
            ]);
            $pdo->query('DELETE FROM category_creator WHERE creator_id = ?', [$this->id]);
            foreach($this->categories as $category) {
                $request = $pdo->query(
                    'INSERT INTO category_creator (category_id, creator_id) VALUES (?, ?)', [
                        $category->getId(),
                        $this->id
                    ]);
            }
            return $request;
    }

    /**
     * Delete un créateur dans la table creator
     *
     * @return bool
     */
    public function delete(): bool
    {
        $pdo = PDOConnector::getInstance();
        $pdo->query('DELETE FROM creator WHERE id = ?', [$this->id]);

        // On supprime dans le catégories les créateurs qui ont été supprimés
        $pdo->query('DELETE FROM category_creator WHERE creator_id = ?', [$this->id]);
        
        return true;
    }
}





    