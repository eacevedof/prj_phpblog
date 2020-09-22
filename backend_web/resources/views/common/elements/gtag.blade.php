<!--gtag.blde.php-->
@if (env('APP_ENV')=="prod" && !$is_ipuntracked)
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-18500857-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'UA-18500857-1');
</script>
@endif
