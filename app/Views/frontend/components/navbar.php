<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top text-dark" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url("/") ?>">The CaCar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= site_url("/") ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= site_url("search") ?>">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= site_url("login") ?>">Admin Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?= $this->section('script') ;?>
<script>
window.onscroll = function() {
    scrollChangeColor()
};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop + 40;

let scrollChangeColor = () => {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("bg-opacity-75")
        console.log("top", window.pageYOffset)
    } else {
        navbar.classList.remove("bg-opacity-75")
    }
}
</script>
<?= $this->endSection() ;?>