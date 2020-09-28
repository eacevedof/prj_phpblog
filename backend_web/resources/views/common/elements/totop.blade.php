<div id="div-totop" class="cmn-divfloat">
    <button onclick="fn_goup()" class="btn btn-primary cmn-btncircle">
        <i class="fa fa-arrow-up"></i>
    </button>
</div>
<script>
const TOUP_Y = 110
const MAX_SCROLL = 115

function fn_goup(){
    window.scrollTo(0, TOUP_Y)
}

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
        if(document.documentElement.scrollTop > MAX_SCROLL){
            $divtop.style.display = "inherit"
        }
        else {
            $divtop.style.display = "none"
        }
    })
})()
</script>
