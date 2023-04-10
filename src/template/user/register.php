<?php include __DIR__ . '/../partials/header.php' ?>

<div class="row justify-content-center mt-3 mb-5 w-100">
    <div class="col-lg-5 col-md-6 col-sm-6 col-12">
        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">S'inscrire</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" novalidate>
                    <?php if (isset($errors) && !empty($errors)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?= $error ?></p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="form-label" for="inputLastName">Nom</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= isset($lastname) ? $lastname : '' ?>" />
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-2" for="inputFirstName">Prénom</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?= isset($firstname) ? $firstname : '' ?>" />
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-2" for="inputEmail">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= isset($email) ? $email : '' ?>" />
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-2" for="inputPassword">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" />
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-2" for="inputPasswordConfirm">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" />
                    </div>
                    <button type="submit" name="register" id="register" class="btn btn-outline-primary btn-lg btn-block w-100 my-3">
                        S'inscrire
                    </button>
                    <p class="small text-right">
                        Vous avez déjà un compte ? <a href="<?= isset($generateUrlLogin) ? $generateUrlLogin : '' ?>">Connectez-vous</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>