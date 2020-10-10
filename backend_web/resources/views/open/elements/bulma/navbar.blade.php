<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/idiomas">
            <b>App Idiomas</b>&nbsp;&nbsp;
            <img src="https://resources.theframework.es/eduardoaf.com/20200917/161342-favicon.ico" alt="eduardoaf.com | languages">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbar-items">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbar-items" class="navbar-menu lang-nav">
        <div class="navbar-end lang-nav">
            <a class="navbar-item lang-nav" href="{{ route('open.home.index') }}">
                <i class="fa fa-home"></i> /
            </a>
            <a href="/blog" class="navbar-item lang-nav">Blog</a>
        </div>
    </div>
</nav>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
        // Add a click event on each of them
        $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {
                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
            });
        });
    }
});
</script>
