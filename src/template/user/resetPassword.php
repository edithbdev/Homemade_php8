<?php include __DIR__ . '/../partials/header.php' ?>

<div class="row justify-content-center mt-3 mb-5 w-100">
    <div class="col-lg-5 col-md-6 col-sm-6 col-12">
        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Reinitialiser votre mot de passe</h3>
                <small class="text-right">
                    Merci de renseigner votre nouveau mot de passe.
                </small>
            </div>
            <div class="card-body">
                <form action="" method="post" novalidate>
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                            <h5 class="alert-heading"><?= $_SESSION['success'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['error'] ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <?php if (isset($errors) && !empty($errors)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?= $error ?></p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="form-label mt-2" for=inputPasswordReset>Mot de passe</label>
                        <input type="password" class="form-control" name="password_resetPassword" id="inputPasswordReset" />
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-2" for="inputPasswordConfirmReset">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" name="passwordConfirm_resetPassword" id="inputPasswordConfirmReset" />
                    </div>
                    <button type="submit" name="resetPassword" id="resetPassword" class="btn btn-outline-primary btn-lg btn-block w-100 my-3">
                        Envoyer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>