<?= $this->extend('frontend/layouts/content') ;?>

<?= $this->section('content') ;?>
<div class="container-fluid p-5 bg-light">
    <div class="row">
        <div class="col-lg-3">
            <form action="<?= site_url("/search") ?>" method="get">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Serach</h3>
                                <div class="card-text">
                                    <div class="form-group">
                                        <label for="Model">Model</label>
                                        <input type="text" class="form-control" name="model" id="Model"
                                            value="<?= $model ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Brand">Brand</label>
                                        <select class="form-control" name="brand" id="Brand">
                                            <option value="">-- select one --</option>
                                            <?php foreach ($brand as $item) : ?>
                                            <option value="<?= $item->id ?>"
                                                <?= ($item->id == $currentBrand) ? "selected" : "" ?>>
                                                <?= $item->title ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button class="btn btn-outline-primary" type="submit">Search Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <h4>Search Result <span class="badge bg-primary text-wrap"><?= count($cars) ?></span></h4>
                <?php if ($isBrand) : ?>
                <div class="card">
                    <div class="card-body">
                        <h4><?= $brandDetail->title ?></h4>
                        <p class="card-text text-break"><?= $brandDetail->detail ?></p>
                    </div>
                </div>
                <?php endif ?>
                <?= $this->include('frontend/components/cardCatalog') ;?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ;?>