<div id="div-totop" style="position: fixed; bottom: 45px; right: 15px;">
    <a href="#span-top" class="btn btn-primary btn-circle">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>
<script type="application/javascript">
(function() {
    window.addEventListener("scroll", function() {
        const $divtop = document.getElementById("div-totop")
        if(document.documentElement.scrollTop > window.innerHeight) {
            $divtop.style.display = "inherit"
        }
        else {
            $divtop.style.display = "none"
        }
    })
})()
</script>
