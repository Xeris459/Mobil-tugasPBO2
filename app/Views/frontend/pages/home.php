<?= $this->extend('frontend/layouts/content') ;?>

<?= $this->section('content') ;?>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="<?= site_url("media/upload/1657556491_be211ef8e7d8d404f67b.png") ?>"></div>
        <div class="swiper-slide"><img src="<?= site_url("media/upload/1657556491_be211ef8e7d8d404f67b.png") ?>"></div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<div class="swiper brandSwiper">
    <div class="swiper-wrapper">
        <?php foreach ($brand as $item) : ?>
        <a href="<?= site_url("search/$item->id") ?>" class="swiper-slide" style="border: 1px solid #dee2e6;">
            <img src="<?= site_url("media/upload/$item->image") ?>">
        </a>
        <?php endforeach ?>
    </div>
</div>

<div class="container-fluid bg-light p-5">
    <div class="row">
        <h2 class="fw-bold">New Catalog</h2>
    </div>
    <div class="row">
        <?= $this->include('frontend/components/cardCatalog') ;?>
    </div>
</div>
<?= $this->endSection() ;?>

<?= $this->section('script') ;?>
<script>
var swiper = new Swiper(".mySwiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".brandSwiper", {
    slidesPerView: 6,
    loop: true,
    spaceBetween: 0,
});
</script>
<?= $this->endSection() ;?>