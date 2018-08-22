@extends('layouts/app')

@section('register')
    <h2>S'inscrire</h2>
    @if ($errors->any())
        <div class="error-message">
            <h4>Oups il y a des erreurs.</h4>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('users.register') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Nom d'utilisateur</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}"/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}"/>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password"/>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmation du mot de passe</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"/>
        </div>
        <div class="form-group">
            <input class="btn" type="submit" value="S'inscrire"/>
        </div>
    </form>
@endsection

@section('content')
    <div class="notification success">
        Les inscriptions sont désactivé pour l'instant
    </div>
@endsection