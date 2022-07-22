<?= $this->extend('frontend/layouts/content') ;?>

<?= $this->section('content') ;?>
<div class="container-fluid bg-light">
    <div class="container-fluid" style="width: 95%">
        <div class="row pt-4">
            <div class="col-lg-10 col-sm-12">
                <div class="card">
                    <img class="card-img-top"
                        style="height: 40rem; width: 100%; object-fit: cover; object-position: center;"
                        src="<?= site_url("media/upload/$detail->image") ?>">
                    <div class="card-body ">
                        <div class="container-fluid">
                            <small class="text-muted"><?= $detail->brand ?></small>
                            <h2><?= $detail->title ?></h2>
                            <p class="card-text text-break">
                                <?= $detail->detail ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-12">
                <div class="row">
                    <h2 class="mb-3">Brand Detail</h2>
                    <div class="card">
                        <img class="card-img-top"
                            style="max-height: 15rem; width: 100%; object-fit: cover; object-position: center;"
                            src="<?= site_url("media/upload/$brand->image") ?>">
                        <div class="card-body ">
                            <h4><?= $brand->title ?></h4>
                            <p class="card-text text-break text-muted">
                                <?= $brand->detail ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h2 class="mb-3 mt-5">More Detail</h2>
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="container"> -->
                            <div class="card-text text-break text-muted row row-cols-2">
                                <?php foreach ($carDetail as $item) : ?>
                                <?php if (!empty($item->title)) : ?>
                                <p class="text-start fw-bolder"><?= $item->title ?></p>
                                <p class="text-end"><?= $item->value ?? "-" ?></p>
                                <?php endif ?>
                                <?php endforeach ?>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid bg-light pt-5 pb-5">
    <div class="container-fluid mt-2" style="width: 95%">
        <div class="row">
            <h2 class="fw-bold">Related Catalog</h2>
        </div>
        <div class="row">
            <?= $this->include('frontend/components/cardCatalog') ;?>
        </div>
    </div>
</div>
<?= $this->endSection() ;?>