@extends('layouts.admin')

@section('content')
    <h2>Paramètres</h2>
    {{ Form::model($settings) }}
        <div class="form-group">
            {{ Form::label('name', "Titre du site") }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
    <div class="form-group">
        {{ Form::submit('Mettre à jour') }}
    </div>
    {{ Form::close() }}
@endsection