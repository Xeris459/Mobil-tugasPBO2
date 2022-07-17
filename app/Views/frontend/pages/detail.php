<?= $this->extend('frontend/layouts/content') ;?>

<?= $this->section('content') ;?>
<div class="container-fluid bg-light">
    <div class="row">
        <div class="card">
            <img class="card-img-top" style="height: 40rem; width: 100%; object-fit: cover; object-position: center;"
                src="<?= site_url("media/upload/1657556491_be211ef8e7d8d404f67b.png") ?>">
            <div class="card-body ">
                <div class="container-fluid">
                    <small class="text-muted">Brand Name</small>
                    <h4>Model Name</h4>
                    <p class="card-text text-break">Some quick example text to build on the card title and make up the
                        bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid bg-light p-5">
    <div class="row">
        <h2 class="fw-bold">Related Catalog</h2>
    </div>
    <div class="row">
        <?= $this->include('frontend/components/cardCatalog') ;?>
        <?= $this->include('frontend/components/cardCatalog') ;?>
        <?= $this->include('frontend/components/cardCatalog') ;?>
        <?= $this->include('frontend/components/cardCatalog') ;?>
    </div>
</div>
<?= $this->endSection() ;?>