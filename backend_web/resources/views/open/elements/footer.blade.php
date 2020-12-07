<footer class="text-center pt-3 pb-1 opn-footer">
    <p class="text-white text-bold">
        <a class="text-white" href="{{ route('open.home.index') }}">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a> /
        <a href="/blog" class="text-white">Blog</a> /
        <a href="/contacto" class="text-white">Contacto</a> /
        <a href="/idiomas" class="text-white">App Idiomas</a> /
        @if(env("APP_ENV")=="test")
            <a href="https://twitter.com/eacevedof" target="_blank" class="text-white" rel="nofollow">@eacevedof</a> /
        @endif
        {{env("APP_ENV")}}
        <a href="https://github.com/eacevedof" target="_blank" class="text-white" rel="nofollow">Github</a>
    </p>
</footer>
