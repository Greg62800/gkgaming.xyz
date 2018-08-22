@extends('layouts/app')

@section('user_profil')
    <div class="user_profil">
        <header>
            <h2>Editer mon compte</h2>
        </header>
    </div>
@endsection

@section('content')
    <div class="row">
        <h2>Mon compte</h2>
        <div class="col-6 col-s-12 col-m-6 col-l-6">
            @if ($errors->any())
                <div class="error-message">
                    <h4>Oups il y a des erreurs.</h4>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            {{ Form::model($user, ['route' => 'users.edit', 'files' => true]) }}
            <div class="form-group">
                {{ Form::label('email', "Email") }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('avatar', "Avatar") }}
                {{ Form::file('avatar') }}
            </div>
            <div class="form-group">
                <input class="btn" type="submit" value="Mettre à jour"/>
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-6 col-s-12 col-m-6 col-l-6">
            @if(empty(Auth::user()->avatar))
                <img class="img-circle" src="{{ Auth::user()->avatar_file }}" alt=""/>
            @else
                <img src="{{ Auth::user()->avatar_file }}" style="border-radius: 50%; width: 70px; height: 70px;" alt=""/>
            @endif
            @if(!empty(Auth::user()->avatar))
                <a href="{{ route('users.del_avatar') }}" id="delete-avatar" class="btn-avatar delete">Supprimer mon avatar</a>
            @endif
        </div>
    </div>
@endsection