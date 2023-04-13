<?php include __DIR__ . '/../partials/header.php'?>

<section class="row mt-5 mb-5 w-100">
    <div class="col-6">
        <h1 class="text-center">Liste des créateurs</h1>
    </div>
</section>

<div class="row d-flex justify-content-around">
<?php if (isset($creators)): ?>
    <?php foreach ($creators as $key => $creator):
        ?>
        <div class="card mb-4 px-0" style="width: 17rem;">
            <img src="/assets/images/<?=$creator->getImage()?>" class="card-img-top w-100" alt="<?=$creator->getImage()?>">
            <div class="card-body">
                <h5 class="card-title"><?=$creator->getFullName()?></h5>
                <p class="card-text"><?=$creator->getDescription()?></p>
            
                <?php foreach ($creator->getCategories() as $category): ?>
                    <?php $categories = explode(',', $category);?>
                    <?php foreach ($categories as $category): ?>
                        <a href="/category/<?=$category?>" class="badge bg-secondary"><?=$category?></a>
                    <?php endforeach;?>
                <?php endforeach;?>
                <div class="card-body text-center">
                <a href="/creator/<?=$creator->getId()?>" class="btn btn-primary text-center">Voir l'atelier</a>
                </div>
            </div>
        </div>
    <?php endforeach;?>
<?php endif;?>
</div>

<?php include __DIR__ . '/../partials/footer.php'?>