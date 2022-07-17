<?= $this->include('backend/layouts/head') ?>
<?= $this->include('backend/layouts/sidebar') ?>
<?= $this->include('backend/layouts/navbar') ?>

<div class="container-fluid">
    <!-- nama halaman dan untuk tombol -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php
        $pagetitle = explode('||', $title);
        ?>
        <h1 class="h3 mb-0 text-gray-800"><?= $pagetitle[0] ?></h1>
    </div>

    <hr>
    <!-- content -->
    <?= $this->include('backend/layouts/notification_form'); ?>
    <?= $this->renderSection('content') ?>

</div>

<?= $this->include('backend/layouts/footer') ?>