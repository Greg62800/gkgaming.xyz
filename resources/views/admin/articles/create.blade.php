@extends('layouts/admin')

@section('content')
    <div class="form-group">
      @if($article->id)
            <h2>Editer l'article</h2>
      @else
            <h2>Ajouter un article</h2>
      @endif
    </div>
    {{ Form::model($article) }}
        @if ($errors->any())
            <div class="error-message">
                <h4>Oups il y a des erreurs.</h4>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-s-12">
                <div class="form-group">
                    {{ Form::label('name', "Titre") }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-s-12">
                <div class="form-group">
                    {{ Form::label('user_id', "Auteur") }}
                    <div class="custom-select">
                      {{ Form::select('user_id', App\User::pluck('name', 'id'), null) }}
                    </div>
                </div>
            </div>
            <div class="col-s-12">
                <div class="form-group">
                    {{ Form::label('category_id', "Catégorie") }}
                    <div class="custom-select">
                        {{ Form::select('category_id', App\Category::pluck('name', 'id'), null) }}
                    </div>
                </div>
            </div>
            <div class="col-s-12">
                <div class="form-group">
                    {{ Form::label('content', "Contenu") }}
                    {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-s-12">
                <div class="form-group">
                    {{ Form::label('video_url', "URL de la vidéo(facultatif)") }}
                    {{ Form::text('video_url', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-s-12">
              <div class="form-group">
                {{ Form::label('online', "En ligne ?") }}
                {{ Form::checkbox('online') }}
              </div>
            </div>
            <div class="col-s-12">
                <input type="submit" value="Sauvegarder"/>
            </div>
        </div>
    {{ Form::close() }}
@endsection
