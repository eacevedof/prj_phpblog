@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card opn-card">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
        <h6>Prueba php <b>preg_match_all</b></h6>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-pregmatchall" class="row g-3">
            <div class="col-sm-4">
                <label>
                    Patrón:
                    <sub>min:8, max:32</sub>
                </label>
                <input type="number" class="form-control" required="required" min="8" max="32"
                    :disabled="issending"
                    v-model="pattern"
                />
            </div>
            <div class="col-sm-4">
                <label>
                    Flags:
                    <sub>ejemplo: 876</sub>
                </label>
                <input type="text" class="form-control" maxlength="4"
                       :disabled="issending"
                       v-model="flags"
                />
            </div>
            <div class="col-sm-2">
                <label>
                    Excluir letras:
                    <sub>ejemplo: axdeo</sub>
                </label>
                <input type="text" class="form-control" maxlength="26"
                       :disabled="issending"
                       v-model="noletters"
                />
            </div>
            <div class="col-sm-3">
                <pre>
                /**
                * Perform a global regular expression match
                * @link https://php.net/manual/en/function.preg-match-all.php
                * @param string $pattern <p>
                    * The pattern to search for, as a string.
                    * </p>
                * @param string $subject <p>
                    * The input string.
                    * </p>
                * @param string[][] $matches [optional] <p>
                    * Array of all matches in multi-dimensional array ordered according to flags.
                    * </p>
                * @param int $flags [optional] <p>
                    * Can be a combination of the following flags (note that it doesn't make
                    * sense to use <b>PREG_PATTERN_ORDER</b> together with
                    * <b>PREG_SET_ORDER</b>):
                    * <b>PREG_PATTERN_ORDER</b>
                    * <p>
                    * Orders results so that $matches[0] is an array of full
                    * pattern matches, $matches[1] is an array of strings matched by
                    * the first parenthesized subpattern, and so on.
                    * </p>
                * @param int $offset [optional] <p>
                    * Normally, the search starts from the beginning of the subject string.
                    * The optional parameter <i>offset</i> can be used to
                    * specify the alternate place from which to start the search (in bytes).
                    * </p>
                * <p>
                    * Using <i>offset</i> is not equivalent to passing
                    * substr($subject, $offset) to
                    * <b>preg_match_all</b> in place of the subject string,
                    * because <i>pattern</i> can contain assertions such as
                    * ^, $ or
                    * (?&lt;=x). See <b>preg_match</b>
                    * for examples.
                    * </p>
                * <p>
                    * <code>
                        * preg_match_all("|]+>(.*)]+>|U",
                        * "example: this is a test",
                        * $out, PREG_PATTERN_ORDER);
                        * echo $out[0][0] . ", " . $out[0][1] . "\n";
                        * echo $out[1][0] . ", " . $out[1][1] . "\n";
                        * </code>
                    * The above example will output:</p>
                * <pre>
                * example: , this is a test
                * example: , this is a test
                * </pre>
                * <p>
                    * So, $out[0] contains array of strings that matched full pattern,
                    * and $out[1] contains array of strings enclosed by tags.
                    * </p>
                * </p>
                * @param int $offset [optional]
                * @return int|false the number of full pattern matches (which might be zero),
                * or <b>FALSE</b> if an error occurred.
                */
                function preg_match_all ($pattern, $subject, array &$matches = null, $flags = PREG_PATTERN_ORDER, $offset = 0) {}
                </pre>
            </div>
            <!-- boton -->
            <div class="col-sm-2 m-0 p-0 pt-4">
                <button id="btn-pregmatchall" class="btn btn-dark m-0 mt-3" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-pregmatchall.js"></script>
@endsection
