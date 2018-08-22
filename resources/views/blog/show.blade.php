@extends('layouts/app')

@section('title')
Blog | {{ $article->name }}
@endsection

@section('content')
    <div class="blog-main">
        <div class="row">
            <div class="col-12 col-s-12 col-m-12 col-l-12">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}">Accueil</a>
                    <span class="separator">/</span>
                    <a href="{{ route('blog.index') }}">Blog</a>
                    <span class="separator">/</span>
                    <span class="active">
                        {{ $article->name }}
                    </span>
                </div>
            </div>
            <div class="col-s-12 col-l-9 col-m-12">
                <article class="article-view">
                    <header>
                        <h2>
                            {{ $article->name }}
                            @if(auth()->check() && Auth::user()->id === 1)
                                <a href="{{ route('admin.articles.edit', $article->id) }}">@lang('message.blog.edit')</a>
                            @endif
                        </h2>
                    </header>
                    <div class="meta">
                        Auteur: {{ $article->user->name }} - Modifié {{ Date::parse($article->updated_at)->diffForHumans() }}
                    </div>
                    <div class="contents">
                        {!! $article->content !!}
                        <div class="video">
                            @if(!empty($article->video_url))
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $article->video_url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>
                </article>
                <section class="comment-form article-view">
                    <h2>{{ $article->comments->count() }} commentaire{{ ($article->comments->count() > 1 ? 's' : '') }}</h2>
                    @if ($errors->any())
                        <div class="error-message">
                            <h4>Oups il y a des erreurs.</h4>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    {{ Form::open(['url' => route('comment.add', $article->slug), 'id' => 'comment-form']) }}
                    <div class="row">
                        @if(Auth::guest())
                            <div class="col-6 col-m-6 col-s-6">
                                <div class="form-group">
                                    {{ Form::label('name', "Pseudo") }}
                                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-6 col-m-6 col-s-6">
                                <div class="form-group">
                                    {{ Form::label('email', "Email") }}
                                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            {{ Form::hidden('user_id', 0) }}
                        @else
                            {{ Form::hidden('name', Auth::user()->name) }}
                            {{ Form::hidden('email', Auth::user()->email) }}
                            {{ Form::hidden('user_id', Auth::user()->id) }}
                        @endif
                        <div class="col-12 col-m-12 col-s-12 col-l-12">
                            <div class="form-group">
                                <label for="content">@lang('message.blog.content')</label>
                                {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                            </div>
                            {{ Form::hidden('parent_id', 0, ['id' => 'parent_id']) }}
                            {{ Form::hidden('blog_id', $article->id) }}
                            <div class="form-group">
                                <input class="btn" type="submit" value="Envoyer"/>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <section class="comments" id="comments">
                        @foreach(\App\Comment::where('parent_id', 0)->where('blog_id', $article->id)->get() as $comment)
                            <div class="comment" id="comment-{{ $comment->id }}">
                                <header>
                                    @if($comment->user_id == 0)
                                        <img class="avatar" src="https://www.gravatar.com/avatar/{{ md5($comment->email) }}" alt=""/>
                                    @else
                                        <img src="{{ $comment->user->avatar_file }}" class="avatar" alt=""/>
                                    @endif
                                </header>
                                <div class="content">
                        <span class="author_name">
                            {{ $comment->name }} -
                            {{ Date::parse($comment->created_at)->diffForHumans() }} -
                            <a class="reply" href="#" data-id="{{ $comment->id }}">Répondre</a> -
                            @if(Auth::user())
                                @if(Auth::user()->id == $comment->user_id || Auth::user()->id == 1)
                                    <a href="{{ route('blog.delete_comment', [$article->slug, $comment->id]) }}" id="btn-link">Supprimer</a>
                                @endif
                            @endif
                        </span>
                                    <div class="body">
                                        {{ $comment->content }}
                                    </div>
                                </div>
                            </div>
                            @foreach($comment->reply as $comment)
                                <div class="comment replies" id="comment-{{ $comment->id }}">
                                    <header>
                                        @if($comment->user_id == 0)
                                            <img class="avatar" src="https://www.gravatar.com/avatar/{{ md5($comment->email) }}" alt=""/>
                                        @else
                                            <img src="{{ $comment->user->avatar_file }}" class="avatar" alt=""/>
                                        @endif
                                    </header>
                                    <div class="content">
                        <span class="author_name">
                            {{ $comment->name }} -
                            {{ Date::parse($comment->created_at)->diffForHumans() }} -
                            @if(Auth::user())
                                @if(Auth::user()->id == 1)
                                    <a href="{{ route('blog.delete_comment', [$article->slug, $comment->id]) }}" id="btn-link">Supprimer</a>
                                @endif
                            @endif
                        </span>
                                        <div class="body">
                                            {{ $comment->content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </section>
                </section>
            </div>
            <div class="col-s-12 col-m-12 col-l-3 sticky">
                @include('blog.sidebar')
            </div>
        </div>
    </div>
@endsection
