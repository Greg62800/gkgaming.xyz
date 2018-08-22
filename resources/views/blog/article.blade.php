@extends('layouts/app')

@section('content')
    <h2>Mes articles</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Etats</th>
            <th>Actions</th>
        </tr>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->name }}</td>
                @if($article->online === 0)
                    <td>
                        <span class="label-danger">Hors ligne</span>
                    </td>
                @else
                    <td>
                        <span class="label-success">En ligne</span>
                    </td>
                @endif
                <td>
                    {{ HTML::link(route('blog.to_propose', $article->id), 'Proposer l\'article') }}
                </td>
            </tr>
        @endforeach
    </table>
@endsection