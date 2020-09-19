<div id="div-totop" class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px; display: none;">
    <a href="#span-top" class="btn-floating btn-large red">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>
<script type="application/javascript">
(function() {
    const $divtop = document.getElementById("div-totop")
    //const $span = document.getElementById("span-top")

    window.addEventListener("scroll",function() {
        console.log(`
          document.documentElement.scrollTop=${document.documentElement.scrollTop},
          window.innerHeight=${window.innerHeight}
        `)
        if(document.documentElement.scrollTop > window.innerHeight) {
            $divtop.style.display = "inherit"
            console.log("divtop style",$divtop)
        }
        else {
            $divtop.style.display = "none"
            console.log("divtop style none",$divtop)
        }
    })
})()
</script>
