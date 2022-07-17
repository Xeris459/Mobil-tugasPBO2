<?= $this->include('frontend/layouts/head') ;?>

<body>
    <?= $this->include('frontend/components/navbar') ;?>

    <?= $this->renderSection('content') ;?>

    <?= $this->include('frontend/layouts/footer') ;?>
</body>

</html>