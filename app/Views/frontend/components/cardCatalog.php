<?php foreach ($cars as $item) : ?>
<a href="<?= site_url("detail/$item->id") ?>" class="col-md-6 col-lg-3 text-decoration-none text-dark">
    <div class="card mt-4">
        <img class="card-img-top" style="height: 10rem; width: 100%; object-fit: cover; object-position: center;"
            src="<?= site_url("media/upload/$item->image") ?>">
        <div class="card-body">
            <small class="text-muted"><?= $item->brand ?></small>
            <h4><?= $item->title ?></h4>
            <p class="card-text text-break"><?= $item->detail ?></p>
        </div>
    </div>
</a>
<?php endforeach ?>