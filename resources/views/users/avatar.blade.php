@extends('layouts/app')


@section('content')
    <h2>Ajouter un avatar</h2>
    {{ Form::model($user, ['files' => true]) }}
        <div class="form-group">
            {{ Form::label('avatar', "Avatar") }}
            {{ Form::file('avatar') }}
        </div>
        <div class="form-group">
            {{ Form::submit('Mettre à jour', ['class' => 'btn']) }}
        </div>
    {{ Form::close() }}
@endsection