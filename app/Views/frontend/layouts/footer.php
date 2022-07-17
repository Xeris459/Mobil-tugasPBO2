<div class="container-fluid bg-dark p-5 text-white">
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="row">
                Brand Name
            </div>

            <div class="row text-muted">
                address
            </div>
        </div>
        <div class="col-lg-8 col-sm-6">
            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-4">
                    <h6>Menu</h6>
                    <div class="row">
                        <a class="text-decoration-none text-white" href="<?= site_url("/") ?>">Home</a>
                    </div>
                    <div class="row">
                        <a class="text-decoration-none text-white" href="<?= site_url("search") ?>">Search</a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <h6>Team</h6>
                    <div class="row">
                        <div class="d-flex align-self-center justify-content-between">
                            <div class="me-4">Vikri Anto <span class="text-secondary">(202012014)</span></div>
                            <div class="align-self-center  flex-fill">
                                <span class="d-flex">
                                    <a href="http://" class="me-2 text-decoration-none text-white">
                                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                    </a>
                                    <a href="http://" class="me-2 text-decoration-none text-white">
                                        <i class="fa fa-twitter-square aria-hidden=" true"></i>
                                    </a>
                                    <a href="http://" class="me-2 text-decoration-none text-white">
                                        <i class="fa fa-github-square" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-self-center justify-content-between">
                            <div class="me-4">Sinta Noviyanti <span class="text-secondary">(202012025)</span></div>
                        </div>
                        <div class="d-flex align-self-center justify-content-between">
                            <div class="me-4">Nur Annisa <span class="text-secondary">(202012019)</span></div>
                            <div class="align-self-center  flex-fill">
                                <span class="d-flex">
                                    <a href="https://www.instagram.com/nr.sakk20/?hl=id"
                                        class="me-2 text-decoration-none text-white">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('frontend/layouts/script') ;?>