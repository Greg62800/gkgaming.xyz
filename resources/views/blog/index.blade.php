@extends('layouts/app')

@section('title')
Blog
@endsection


@section('content')
    <div class="blog-main">
        <div class="row">
            <div class="col-12 col-s-12 col-m-12 col-l-9">
                @if(isset($no_result))
                    <div class="notification info">
                        Aucun article trouvé pour "{{ request()->get('q') }}"
                    </div>
                @endif
                @foreach($blog as $article)
                    <article class="posts">
                        <header>
                            <h2>{{ HTML::link($article->url, $article->name) }}</h2>
                        </header>
                        <div class="meta">
                            <span class="author"><i class="fa fa-user"></i> {{ $article->user->name }}</span>
                            <span class="comments">
                                <a href="{{ route('blog.show', $article->slug) }}#comments">
                                    <i class="fa fa-comments"></i>
                                    {{ $article->comments->count() }} Commentaire
                                </a>
                            </span>
                            <span class="category">
                                <i class="fa fa-tag"></i>
                                {{ $article->category->name }}
                            </span>
                        </div>
                        <div class="contents">
                            {!! Str::words($article->content, 100) !!}
                            <a href="{{ $article->url }}" class="read__more">
                                Lire la suite
                            </a>
                        </div>
                    </article>
                @endforeach
                @include('pagination.default', ['paginator' => $blog])
            </div>
            <div class="col-s-12 col-m-12 col-l-3 sticky">
                @include('blog.sidebar')
            </div>
        </div>
    </div>
@endsection
