@extends('layouts/app')


@section('content')
    <div class="blog-main">
        <div class="row">
            <div class="col-s-12 col-m-12 col-l-10">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}">Accueil</a>
                    <span class="separator">/</span>
                    <a href="{{ route('blog.index') }}">Blog</a>
                    <span class="separator">/</span>
                    <a href="{{ route('category.name', $category->slug) }}">{{ $category->name }}</a>
                    <span class="separator">/</span>
                    <span class="active">{{ $article->name }}</span>
                </div>
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
                        {{ $article->content }}
                    </div>
                </article>
            </div>
            <div class="col-s-12 col-m-12 col-l-2 sticky">
                @include('blog.sidebar')
            </div>
        </div>
    </div>
@endsection
