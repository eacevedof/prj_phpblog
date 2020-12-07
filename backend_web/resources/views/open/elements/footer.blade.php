<footer class="text-center pt-3 pb-1 opn-footer">
    <p class="text-white text-bold">
        <a class="text-white" href="{{ route('open.home.index') }}">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a> /
        <a href="/blog" class="text-white">Blog</a> /
        <a href="/contacto" class="text-white">Contacto</a> /
        @if(env("APP_ENV")=="test")
            <a href="/idiomas" class="text-white">App Idiomas</a> /
        @endif
        <a href="https://twitter.com/eacevedof" target="_blank" class="text-white" rel="nofollow">@eacevedof</a> /
        <a href="https://github.com/eacevedof" target="_blank" class="text-white" rel="nofollow">Github</a>
    </p>
</footer>
