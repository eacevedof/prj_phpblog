@if(isset($subject))
<section class="hero is-primary">
    <div class="hero-body">
        <div class="columns">
            <div class="column is-12">
                <div class="container content">
                    <h1 class="title">{{$subject->title}}</h1>
                    <h3 class="subtitle">
                        {{$subject->excerpt}}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
