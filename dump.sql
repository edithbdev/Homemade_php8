/* script de création de la base de données */
/* création de la base de données */
DROP DATABASE IF EXISTS `homemade`;
CREATE DATABASE `homemade` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `homemade`;

/* Structure de la table `user` */
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` blob NOT NULL, /* password crypté, blob pour stocker les données binaires */
  `token` varchar(200) DEFAULT NULL, /* token de connexion */
  `role` enum('admin','creator','user') NOT NULL DEFAULT 'user', /* rôle de l'utilisateur */
  `is_active` tinyint(1) NOT NULL DEFAULT '0', /* compte actif ou non */
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`) /* email unique */
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/* password = Motdepasse1 */
INSERT INTO `user` VALUES 
(1,'nom1','prenom1','mail1@gmail.fr','$2y$10$fKlFbOLEQleQgg/ZJUFag.Ie2.ZFU48OdHo9oEKHPfUZm9FTUBM4C','e50b173f4b343771873090875ba122c31787a866f58d448165fedeeb30624781','admin',1,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(2,'nom2','prenom2','mail2@gmail.fr','$2y$10$aY3sqKvUdq5MhNEdPkO11e/oU34DxoUAp1kh5zE94XMQflgVGl0xq','65c8f67fbabdaca7579d44e88111df27276942311da079d2e108a7740c7347c9','creator',1,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(3,'nom3','prenom3','mail3@gmail.fr','$2y$10$FeXdrXdFYNBCRyThgKc54eO3RL7w2rWmlu4Y9yhL9WaUJT7/ujLDG','035c16778c36e7c7d61552c3992c9bf449c7103f33e209b911e402b92f4dcf1c','user',1,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(4,'nom4','prenom4','mail4@gmail.fr','$2y$10$hA8VKa31mxpJc6BwhHxph.r0dmnV7z2D3i8bC/31tPHVHpdPSLNo.','d4cb014d02b09f7b97975c22d0e75f80ebf353f5488b4b377d5bccb90d32c94e','user',1,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

/* Structure de la table `creator` */
DROP TABLE IF EXISTS `creator`;
CREATE TABLE `creator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `brand` varchar(40) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `site_perso` varchar(200) DEFAULT NULL,
  `link_fb` varchar(200) DEFAULT NULL,
  `link_insta` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` enum('pending','validated','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`) /* email unique */
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `creator` WRITE;
INSERT INTO `creator` VALUES 
(1,'nom1','prenom1','brand1','https://randomuser.me/api/portraits/women/92.jpg','peintre.jpg','https://site_perso1','https://facebook.com','https://instagram.com','mail1@free.fr','0102030405','description1','pending','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(2,'nom2','prenom2','brand2','https://randomuser.me/api/portraits/women/29.jpg','artiste1.jpg',NULL,NULL,'https://instagram.com','mail2@free.fr','0203040506','description2','pending','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(3,'nom3','prenom3','brand3','https://randomuser.me/api/portraits/men/0.jpg','artiste2.jpg','https://site_perso3','https://facebook.com',NULL,'mail3@gmail.com','0304050607','description3','validated','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(4,'nom4','prenom4','brand4','https://randomuser.me/api/portraits/women/30.jpg','photographe','https://site_perso4','https://facebook.com','https://instagram.com','mail4@gmail.fr','0601020304','description4','pending','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(5,'nom5','prenom5','brand5','https://randomuser.me/api/portraits/men/55.jpg','designer.jpg',NULL,'https://facebook.com',NULL,'mail5@free.fr','0602030405','description5','validated','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(6,'nom6','prenom6','brand6','https://randomuser.me/api/portraits/women/40.jpg','ecrivain.jpg','https://site_perso6',NULL,'https://instagram.com','mail6@free.fr','0603040506','description6','pending','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(7,'nom7','prenom7','brand7','https://randomuser.me/api/portraits/men/35.jpg','couturier.jpg','https://site_perso7',NULL,'https://instagram.com','mail7@free.fr','0405060708','description7','pending','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(8,'nom8','prenom8','brand8','https://randomuser.me/api/portraits/men/92.jpg','sculpteur.jpg',NULL,'https://facebook.com','https://instagram.com','mail8@free.fr','0606070809','description8','validated','2020-05-01 00:00:00','2020-05-01 00:00:00',NULL);
UNLOCK TABLES;

/*Structure de la table `user_creator`*/
DROP TABLE IF EXISTS `user_creator`;
CREATE TABLE `user_creator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_creator` (`user_id`,`creator_id`),
  KEY `user_id` (`user_id`),
  KEY `creator_id` (`creator_id`),
  CONSTRAINT `user_creator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,/*permet de supprimer les données de la table user_creator si on supprime une donnée de la table user*/
  CONSTRAINT `user_creator_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `creator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE /*permet de supprimer les données de la table user_creator si on supprime une donnée de la table creator*/
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `user_creator` WRITE;
INSERT INTO `user_creator` VALUES 
(1,1,1,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(2,2,2,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(3,3,3,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL),
(4,4,4,'2020-05-01 00:00:00','2020-05-01 00:00:00',NULL);
UNLOCK TABLES;

/* Structure de la table `category` */
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) /* nom unique */
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `category` WRITE;
INSERT INTO `category` VALUES 
(1,'artiste','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(2,'artisan','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(3,'créateur','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(4,'designer','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(5,'écrivain','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(6,'entrepreneur','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(7,'photographe','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(8,'producteur','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(9,'réalisateur','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(10,'scénariste','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(11,'sportif','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(12,'technicien','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(13,'traducteur','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(14,'vidéaste','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(15,'autre','https://picsum.photos/300','2020-05-01 00:00:00','2020-05-01 00:00:00');
UNLOCK TABLES;

/* Structure de la table `product` */
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_creator` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sold` tinyint(1) DEFAULT 0, /* 0 = non vendu, 1 = vendu */
  `description` varchar(200) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_creator` (`id_creator`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `creator` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `product` WRITE;
INSERT INTO `product` VALUES 
(1,1,'nom du product1','peinture1.jpg',0,'description du product1',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(2,2,'nom du product2','sculpture1.jpg',0,'description du product2',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(3,3,'nom du product3','sculpture.jpg',1,'description du product3',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(4,4,'nom du product4','peinture.jpg',0,'description du product4',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(5,5,'nom du product5','couture1.jpg',1,'description du product5',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(6,6,'nom du product6','photographe1.jpg',1,'description du product6',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(7,7,'nom du product7','poterie1.jpg',1,'description du product7',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(8,8,'nom du product8','couture2.jpg',0,'description du product8',10.00,'https://www.google.com','2020-05-01 00:00:00','2020-05-01 00:00:00');
UNLOCK TABLES;

/* Structure de la table `category_product` */
DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `category_product` WRITE;
INSERT INTO `category_product` VALUES 
(1,1,1,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(2,2,2,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(3,3,3,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(4,4,4,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(5,5,5,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(6,6,6,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(7,7,7,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(8,8,8,'2020-05-01 00:00:00','2020-05-01 00:00:00');
UNLOCK TABLES;

/* Structure de la table `favorite` */
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `favorite` WRITE;
INSERT INTO `favorite` VALUES 
(1,1,1,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(2,2,2,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(3,3,3,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(4,4,4,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(5,1,5,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(6,2,6,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(7,3,7,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(8,3,8,'2020-05-01 00:00:00','2020-05-01 00:00:00');
UNLOCK TABLES;

/* Structure de la table `category_creator` */
DROP TABLE IF EXISTS `category_creator`;
CREATE TABLE `category_creator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_creator` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_creator` (`id_creator`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `category_creator_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `creator` (`id`),
  CONSTRAINT `category_creator_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `category_creator` WRITE;
INSERT INTO `category_creator` VALUES 
(1,1,1,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(2,2,2,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(3,3,3,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(4,4,4,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(5,5,5,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(6,6,6,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(7,7,7,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(8,8,8,'2020-05-01 00:00:00','2020-05-01 00:00:00');
UNLOCK TABLES;

/* Structure de la table `comments` */
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_creator` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_creator` (`id_creator`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `creator` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `comments` WRITE;
INSERT INTO `comments` VALUES 
(1,1,1,'commentaire1','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(2,2,2,'commentaire2','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(3,3,3,'commentaire3','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(4,4,4,'commentaire4','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(5,5,5,'commentaire5','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(6,6,6,'commentaire6','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(7,7,7,'commentaire7','2020-05-01 00:00:00','2020-05-01 00:00:00'),
(8,8,8,'commentaire8','2020-05-01 00:00:00','2020-05-01 00:00:00');
UNLOCK TABLES;

/* Structure de la table `score` */
DROP TABLE IF EXISTS `score`;
CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_creator` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_creator` (`id_creator`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `score_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `creator` (`id`),
  CONSTRAINT `score_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `score` WRITE;
INSERT INTO `score` VALUES 
(1,1,1,1,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(2,2,2,2,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(3,3,3,3,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(4,4,4,4,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(5,5,5,5,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(6,6,6,1,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(7,7,7,2,'2020-05-01 00:00:00','2020-05-01 00:00:00'),
(8,8,8,3,'2020-05-01 00:00:00','2020-05-01 00:00:00');
UNLOCK TABLES;

/* fin du script */




