<div id="div-totop" class="cmn-divfloat">
    <a href="#span-top" class="btn btn-primary cmn-btncircle">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>
<script type="application/javascript">
(function() {
    console.log(`document.documentElement.scrollTop:${document.documentElement.scrollTop}, window.innerHeight:${window.innerHeight}`);
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
