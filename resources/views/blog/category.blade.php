@extends('layouts/app')


@section('content')
    <div class="blog-main">
        <div class="breadcrumb">
            {{ $category->name }}
        </div>
        <div class="row">
            <div class="col-s-12 col-m-12 col-l-10">
                @foreach($blog as $article)
                    <article class="posts">
                        <header>
                            <h2>{{ HTML::link(route('blog.category_post', [$article->category->slug, $article->slug]), $article->name) }}</h2>
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
                                {{ $article->category->name }}
                            </span>
                        </div>
                        <div class="contents">
                            {{ Str::words($article->content, 25) }}
                            <a href="{{ $article->url }}" class="read__more">
                                Lire la suite
                            </a>
                        </div>
                    </article>
                @endforeach
                @include('pagination.default', ['paginator' => $blog])
            </div>
            <div class="col-s-12 col-m-12 col-l-2 sticky">
                @include('blog.sidebar')
            </div>
        </div>
    </div>
@endsection
