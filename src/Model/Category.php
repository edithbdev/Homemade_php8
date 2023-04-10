<?php

namespace App\Model;

use App\Service\PDOConnector;
use PDO;

/**
 * Category Model
 */
class Category
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $image;

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
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
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
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return self
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     * @return self
     */
    public function setUpdatedAt(string $updated_at): self
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
     * On récupère les données d'une catégorie
     * 
     * @param int $id
     *
     * @return Category|false
     */
    public static function find(int $id): Category | false
    {
        $pdo = PDOConnector::getInstance();
        $request = $pdo->query("SELECT * FROM category WHERE id = ?", ([$id]));
        return $request->fetchObject(self::class);
    }
}
