@extends('layouts/admin')

@section('content')
    <h2>Editer l'article</h2>
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
                {{ Form::label('user_id', 'Auteur') }}
                {{ Form::select('user_id', \App\User::pluck('name', 'id'), null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-s-12">
            <div class="form-group">
                {{ Form::label('content', "Contenu") }}
                {{ Form::textarea('content', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-s-12">
            <input type="submit" value="Mettre à jour"/>
        </div>
    </div>
    {{ Form::close() }}
@endsection