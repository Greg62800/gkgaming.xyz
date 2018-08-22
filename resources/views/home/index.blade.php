@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="blog-main">
            <h2 class="title">Les derniers articles</h2>
            @foreach($articles as $article)
                <div class="col-12 col-s-12 col-m-6 col-l-3">
                    <article class="article">
                        <header>
                            <h4>{{ HTML::link($article->url, $article->name) }}</h4>
                        </header>
                        <div class="meta">
                            <span class="author"><i class="fa fa-user"></i> {{ $article->user->name }}</span>
                            <span class="comments">
                                <a href="{{ route('blog.show', $article->slug) }}#comments">
                                    <i class="fa fa-comments"></i>
                                    {{ $article->comments->count() }} Commentaire
                                </a>
                            </span>
                        </div>
                        <div class="contents">
                            {{ Str::words($article->content, 25) }}
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
@endsection