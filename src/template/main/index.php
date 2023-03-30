<?= self::returnTemplate('partials/header') ?>

<section class="row mt-5 mb-5 w-100">
    <div class="col-6">
        <h1 class="text-center">Bienvenue sur HomeMade</h1>
        <p class="text-center">L'atelier des créateurs</p>
        <p class="text-justify">Ut reprehenderit deserunt anim exercitation. Occaecat est reprehenderit incididunt cupidatat mollit consectetur dolore et enim ex id.
            Laborum ut non sunt occaecat velit Lorem culpa dolor non ipsum sint. Eiusmod qui aliqua aliquip consequat quis veniam cupidatat sunt veniam consequat velit quis ad.
            Labore eu est exercitation commodo ullamco culpa mollit in voluptate enim deserunt veniam.
        </p>
        <p class="text-justify">Ut reprehenderit deserunt anim exercitation. Occaecat est reprehenderit incididunt cupidatat mollit consectetur dolore et enim ex id.
            Laborum ut non sunt occaecat velit Lorem culpa dolor non ipsum sint. Eiusmod qui aliqua aliquip consequat quis veniam cupidatat sunt veniam consequat velit quis ad.
            Labore eu est exercitation commodo ullamco culpa mollit in voluptate enim deserunt veniam.
        </p>
    </div>
    <div class="col-6">

        <h1>Les derniers créateurs...</h1>
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <?php foreach ($creators as $key => $creator) : ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" class="<?= $key === 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $key ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($creators as $key => $creator) : ?>
                    <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                        <img src="/assets/images/<?= $creator->getImage() ?>" class="d-block w-100" alt="<?= $creator->getImage() ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $creator->getFullName() ?></h5>
                            <p><?= $creator->getDescription() ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<?= self::returnTemplate('partials/footer') ?>