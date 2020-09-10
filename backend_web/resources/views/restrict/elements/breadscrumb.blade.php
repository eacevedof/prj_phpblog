<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/adm">Admin</a></li>
        @if($module=="post")
            <li class="breadcrumb-item"><a href="/adm/posts">Posts</a></li>
            <li class="breadcrumb-item"><a href="/adm/post/insert">Insert post</a></li>
        @endif
        @if($module=="upload")
            <li class="breadcrumb-item"><a href="/adm/upload">Upload</a></li>
         <!--
            <li class="breadcrumb-item"><a href="/adm/upload/insert">Insert upload</a></li>
         -->
        @endif
    </ol>
</nav>
