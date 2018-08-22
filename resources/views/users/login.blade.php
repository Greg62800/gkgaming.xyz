@extends('layouts.app')

@section('content')
    <h2>Se connecter</h2>
    <form action="{{ route('users.login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Nom d'utilisateur ou email</label>
            <input class="form-control" type="text" name="name" id="name"/>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password"/>
        </div>
        <div class="form-group">
            <input class="btn" type="submit" value="Se connecter"/>
        </div>
    </form>
@endsection