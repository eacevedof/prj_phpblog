<div id="btnTop" class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;display: none;">
    <a href="#topSection" class="btn-floating btn-large red">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>
<script type="application/javascript">
(function() {
    const $btn = document.getElementById("btnTop")
    const $home = document.getElementById("topSection")
    const startpoint = $home.scrollTop + $home.style.height;

    window.addEventListener("scroll",function() {
        if(window.pageYOffset > startpoint) {
            $btn.style.display = "inline-block"
        } else {
            $btn.style.display = "none"
        }
    })
})()
</script>
