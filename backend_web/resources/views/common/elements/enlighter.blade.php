<script type="text/javascript" src="{{ asset('assets/enlighter/enlighterjs.min.js') }}"></script>
<script type="text/javascript">
    // INIT CODE - simple page-wide initialization based on css selectors
    // - highlight all pre + code tags (CSS3 selectors)
    // - use javascript as default language
    // - use theme "enlighter" as default theme
    // - replace tabs with 2 spaces
    EnlighterJS.init('pre', 'code', {
        language : 'javascript',
        theme: 'enlighter',
        indent : 2
    });
</script>
