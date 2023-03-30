<?php

namespace Model;

use PDO;
use Exception;
use Service\PDOConnector;

/**
 * Model Creator
 *
 * Cette classe représente un créateur
 * Contient les propriétés et méthodes
 */

class Creator
{
    /**
     * Creator lastname
     *
     * @var string
     */
    protected $lastname;

    /**
     * Creator firstname
     *
     * @var string
     */
    protected $firstname;

    /**
     * Get fullname
     *
     * @return  string
     */
    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Creator brand
     * @var string
     */
    protected $brand;

    /**
     * Creator photo
     * @var string
     */
    protected $photo;

    /**
     * Creator image
     * @var string
     */
    protected $image;

    /**
     * Creator site_perso
     * @var string
     */
    protected $site_perso;

    /**
     * Creator link_fb
     * @var string
     */
    protected $link_fb;

    /**
     * Creator link_insta
     * @var string
     */
    protected $link_insta;

    /**
     * Creator email
     * @var string
     */
    protected $email;

    /**
     * Creator phone
     * @var string
     */
    protected $phone;

    /**
     * Creator description
     * @var string
     */
    protected $description;

    /**
     * Creator status
     * @var string
     */
    protected $status;

    /**
     * Creator created_at
     * @var string
     */
    protected $created_at;

    /**
     * Creator updated_at
     * @var string
     */
    protected $updated_at;

    /**
     * Creator deleted_at
     * @var string
     */
    protected $deleted_at;

    /**
     * Category du Creator
     * @var Category
     */
    protected $category;

    /**
     * Get Category
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set Category
     * @param Category $category
     * @return self
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * id
     * @var int
     */
    protected $id;

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get lastname
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set lastname
     * @param string $lastname
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get firstname
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set firstname
     * @param string $firstname
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get brand
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set brand
     * @param string $brand
     * @return self
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * Get photo
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set photo
     * @param string $photo
     * @return self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * Get image
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     * @param string $image
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get site_perso
     * @return string
     */
    public function getSite_perso()
    {
        return $this->site_perso;
    }

    /**
     * Set site_perso
     * @param string $site_perso
     * @return self
     */
    public function setSite_perso($site_perso)
    {
        $this->site_perso = $site_perso;
        return $this;
    }

    /**
     * Get link_fb
     * @return string
     */
    public function getLink_fb()
    {
        return $this->link_fb;
    }

    /**
     * Set link_fb
     * @param string $link_fb
     * @return self
     */
    public function setLink_fb($link_fb)
    {
        $this->link_fb = $link_fb;
        return $this;
    }

    /**
     * Get link_insta
     * @return string
     */
    public function getLink_insta()
    {
        return $this->link_insta;
    }

    /**
     * Set link_insta
     * @param string $link_insta
     * @return self
     */
    public function setLink_insta($link_insta)
    {
        $this->link_insta = $link_insta;
        return $this;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get phone
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     * @param string $phone
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get status
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     * @param string $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get created_at
     * @return string
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set created_at
     * @param string $created_at
     * @return self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set updated_at
     * @param string $updated_at
     * @return self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * Get deleted_at
     * @return string
     */
    public function getDeleted_at()
    {
        return $this->deleted_at;
    }

    /**
     * Set deleted_at
     * @param string $deleted_at
     * @return self
     */
    public function setDeleted_at($deleted_at)
    {
        $this->deleted_at = $deleted_at;
        return $this;
    }

    /**
     * On récupère les données de la table creator
     *
     * @param [int] $id
     * @return Creator
     */
    public static function find($id)
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM creator WHERE id = ' . $id);
        return $request->fetchObject(self::class);
    }

    /**
     * On récupère toutes les données de la table creator
     *
     * @return Creator[]
     */
    public static function findAll()
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM creator');
        return $request->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * On récupère les 3 derniers créateurs inscrits
     *
     * @return array
     */
    public static function findLasts()
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query('SELECT * FROM creator ORDER BY created_at DESC LIMIT 3');
        return $request->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Insert un nouveau créateur dans la table creator
     * 
     * @return bool
     */
    public function insert()
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query(
            'INSERT INTO creator (lastname, firstname, site_perso, link_fb, link_insta, mail, phone, image, description, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $this->lastname, 
                $this->firstname, 
                $this->site_perso, 
                $this->link_fb, 
                $this->link_insta, 
                $this->mail, 
                $this->phone, 
                $this->image,
                $this->description, 
                $this->status, 
                $this->created_at = date('Y-m-d H:i:s'),
                $this->updated_at = date('Y-m-d H:i:s')
            ]);
            $creator_id = $request[1]; // on récupère l'id du créateur inséré
            foreach($this->categories as $category) {
                $request = $pdo->query(
                    'INSERT INTO category_creator (category_id, creator_id) VALUES (?, ?)', [
                        $category->getId(),
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
    public function update()
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query(
            'UPDATE creator SET lastname = ?, firstname = ?, site_perso = ?, link_fb = ?, link_insta = ?, mail = ?, phone = ?, image = ?, description = ?, status = ?, updated_at = ? WHERE id = ?', [
                $this->lastname, 
                $this->firstname, 
                $this->site_perso, 
                $this->link_fb, 
                $this->link_insta, 
                $this->mail, 
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
    public function delete()
    {
        $pdo = PDOConnector::getInstance();
        $pdo->query('DELETE FROM creator WHERE id = ?', [$this->id]);

        // On supprime dans le catégories les créateurs qui ont été supprimés
        $pdo->query('DELETE FROM category_creator WHERE creator_id = ?', [$this->id]);
        
        return true;
    }
}





    