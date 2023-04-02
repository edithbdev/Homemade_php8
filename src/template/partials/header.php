<!-- entête du site -->
<!doctype html>
<html lang="fr">

<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Site de créateurs artisanaux, L'atelier des créateurs">
  <meta name="author" content="Homemade">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">

  <title>HomeMade</title>
</head>

<?php
$page = $_GET['page'] ?? 'home';
?>

<body>
  <main class="container">
    <div class="mt-4 p-5 bg-secondary text-white rounded">
      <div class="d-flex justify-content-between">
        <div>
          <?php if (isset($_SESSION['user'])) : ?>
            <h1>Bienvenue, <em class="text-warning"><?= $_SESSION['user']->getFirstname() . ' ' . $_SESSION['user']->getLastname() ?></em></h1>
          <?php endif; ?>
        </div>
        <div class="d-flex justify-content-end flex-column">
          <div class="col-6 pb-2 w-100">
            <?php if (!isset($_SESSION['user'])) : ?>
              <a href="<?= self::generateUrl('user_login') ?>" class="btn btn-sm btn-outline-light btn-lg btn-block">Connexion</a>
            <?php else : ?>
              <a href="<?= self::generateUrl('user_logout') ?>" class="btn btn-sm btn-outline-light btn-lg btn-block">Déconnexion</a>
            <?php endif; ?>
          </div>
          <div class="col-6 pb-2 w-100">
            <?php if (!isset($_SESSION['user'])) : ?>
              <a href="<?= self::generateUrl('user_register') ?>" class="btn btn-sm btn-outline-light btn-lg btn-block">Inscription</a>
            <?php else : ?>
              <a href="/profile" class="btn btn-sm btn-outline-light btn-lg btn-block">Mon compte</a>
            <?php endif; ?>
          </div>
          <div class="col-6 w-100">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'user') : ?>
              <a href="/shop-create" class="btn btn-sm btn-outline-light btn-lg btn-block">Ouvrir un atelier</a>
            <?php endif; ?>
          </div>
          <div class="col-6 w-100">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'creator') : ?>
              <a href="/shop" class="btn btn-sm btn-outline-light btn-lg btn-block">Mon atelier</a>
            <?php endif; ?>
          </div>
          <div class="col-6 w-100">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') : ?>
              <a href="/admin" class="btn btn-sm btn-outline-light btn-lg btn-block">Administration</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div>
        <h1 class="display-4">HomeMade</h1>
        <p class="lead">L'atelier des créateurs</p>
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link <?php if ($page === 'home') echo 'active'; ?>" aria-current="page" href="<?= self::generateUrl('main_index') ?>">Accueil</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Catégories</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Link</a>
          </li>
        </ul>
      </div>
    </div>