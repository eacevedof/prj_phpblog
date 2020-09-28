<div id="div-totop" class="cmn-divfloat">
    <a href="#span-top" class="btn btn-primary cmn-btncircle">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>
<script type="application/javascript">
(function() {
    const $divtop = document.getElementById("div-totop")
    //window.scrollY + document.querySelector('#elementId').getBoundingClientRect().top // Y
    //window.scrollX + document.querySelector('#elementId').getBoundingClientRect().left // X

    //console.log(`document.documentElement.scrollTop:${document.documentElement.scrollTop}, window.innerHeight:${window.innerHeight}`);
    window.addEventListener("scroll", function() {
        //const divY = window.scrollY + $divtop.getBoundingClientRect().top
        //console.log("scrolltop:", document.documentElement.scrollTop, "scrolly", window.scrollY)
        //console.log("divtop.y:",$divtop.getBoundingClientRect().top,"scrolltop",document.documentElement.scrollTop)
        //if(document.documentElement.scrollTop > window.innerHeight){
        if(document.documentElement.scrollTop > 115){
            $divtop.style.display = "inherit"
        }
        else {
            $divtop.style.display = "none"
        }
    })
})()
</script>
