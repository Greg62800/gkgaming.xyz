@extends('layouts/admin')

@section('content')
    <div class="row">
        <div class="col-12 col-l-12 col-m-12 col-s-12">
        <h2>Articles</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Commentaire</th>
                <th>Actions</th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->user->name }}</td>
                    <td>{{ $article->comments->count() }}</td>
                    <td>
                        <a href="{{ route('blog.show', $article->slug) }}">Voir l'article</a> -
                        <a href="{{ route('admin.articles.edit', $article->id) }}">Editer l'article</a> -
                        <a href="{{ route('admin.articles.destroy', $article->id) }}" onclick="return confirm('Sûr?');">Supprimer l'article</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <p>&nbsp;</p>
    <div class="col-12 col-l-12 col-m-12 col-s-12">
        <h2>Commentaires</h2>
        <table>
            <tr>
                <th>Contenu</th>
                <th>Auteur</th>
                <th>Actions</th>
            </tr>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->name }}</td>
                    <td>
                        <a href="{{ route('admin.comments.edit', $comment->id) }}">Editer l'article</a> -
                        <a href="{{ route('admin.comments.destroy', $comment->id) }}" onclick="return confirm('Sûr?');">Supprimer ce commentaire</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    </div>
@endsection
