# Homemade

## PHP8 - Docker - Apache - MySQL - PHPMyAdmin - Bootstrap [...]

Ce projet est un site vitrine pour mettre en avant le travail des artisans.
Il est réalisé avec PHP 8, Docker, Apache, MySQL et Bootstrap.
J'utilise le modèle MVC (Model View Controller) pour structurer mon code.

## Technologies utilisées

- [PHP 8](https://www.php.net/releases/8.0/en.php)
- [composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/fr/)
- [PDO](https://www.php.net/manual/fr/book.pdo.php)
- [PHPMyAdmin](https://www.phpmyadmin.net/)
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Apache](https://httpd.apache.org/)
- [Bootstrap](https://getbootstrap.com/)
- [phpunit](https://phpunit.de/)
- [PHPStan](https://phpstan.org/)

## Fonctionnalités

- [ ] CRUD User
- [ ] CRUD Creator
- [ ] CRUD Product
- [ ] CRUD Category
- [ ] CRUD Favorite
- [x] Routing
- [x] Register user
- [ ] Register creator
- [ ] Profile
- [x] Login
- [x] Logout
- [x] Password forgotten
- [x] Password reset
- [x] Email de confirmation d'inscription
- [ ] Search by criteria  
- [ ] [...]

## Installation

- Cloner le projet
- Lancer la commande `composer install`
- Créer un fichier .env.dev à la racine du projet

```bash
touch .env.dev
```

- Copier le contenu du fichier .env.example dans le fichier .env.dev

```bash
cp .env.example .env.dev
```

- Modifier les variables d'environnement dans le fichier .env.dev avec les valeurs de votre choix

### Prérequis

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [mkcert]

### Certificat SSL (vous devez avoir mkcert préalablement installé)

- Créer un dossier `ssl` dans le dossier `docker`
- Lancer la commande `mkcert -install`
- Lancer la commande `mkcert localhost 127.0.0.1 ::1`
- Renommer le certificat et la clé

```bash
mv localhost.pem cert.pem
mv localhost-key.pem cert-key.pem
```

- Copier les fichiers `cert.pem` et `cert-key.pem` dans le dossier `./docker/ssl/`
- Accéder au site en HTTPS : [https://localhost](https://localhost)

### Docker

- Lancer la commande `docker-compose build`
- Lancer la commande `docker-compose up -d`

### Installer les dépendances

- Lancer la commande `docker exec -it php8 bash`

```bash
composer install
```

### Création de la base de données et des tables

- Copier le fichier dump.sql dans le dossier `./docker-entrypoint-initdb.d/`

```bash
docker cp dump.sql db:/docker-entrypoint-initdb.d/dump.sql
```

- Lancer la commande `docker exec -it db bash`
- Lancer la commande `mysql -u root -p`
- Entrer le mot de passe de la base de données
- Lancer la commande `source /docker-entrypoint-initdb.d/dump.sql`
- Vérifier que la base de données a bien été créée avec la commande `show databases;`
- Sélectionner la base de données avec la commande `use homemade;`
- Voir les tables créées avec la commande `show tables;`
- Quitter le container db avec la commande `exit`

## Tests

### Création de la base de données de test

- Lancer la commande `docker exec -it db bash`
- Lancer la commande `mysql -u root -p`
- Entrer le mot de passe de la base de données
- Lancer la commande `CREATE DATABASE homemade_test;`
- Quitter le container db avec la commande `exit`

### Création du fichier .env.test

- Créer un fichier .env.test à la racine du projet

```bash
touch .env.test
```

- Copier le contenu du fichier .env.example dans le fichier .env.test

```bash
cp .env.example .env.test
```

- Modifier les variables d'environnement dans le fichier .env.test avec les valeurs de votre choix

### Lancez les tests

- Lancer la commande `docker exec -it php8 bash`
- Lancer la commande `composer test`

## Lancez l'analyse du code avec PHPStan

- Lancer la commande `docker exec -it php8 bash`
- Lancer la commande `composer phpstan`

## Accéder au site

- [http://localhost:8888](http://localhost:8888)

## Accéder à phpMyAdmin

- [http://localhost:8081](http://localhost:8081)
- Entrer le nom d'utilisateur et le mot de passe de la base de données

## Accèder au mailhog

- [http://localhost:8025](http://localhost:8025)

## Auteur

Edith Bredon - [edithbredon.fr](https://www.edithbredon.fr/)
