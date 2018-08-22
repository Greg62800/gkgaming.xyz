@extends('layouts.app')

@section('user_profil')
    <div class="user_profil">
        <header>
            <h2>Mon compte</h2>
        </header>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12 col-l-12 col-m-12 col-s-12">
            <h2>Tout vos badges</h2>
            @foreach($user->badges as $notification)
                <li>{{ $notification->name }}</li>
            @endforeach
        </div>
    </div>
@endsection