<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\Notifications\NewComments;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CommentsController extends Controller
{
    public function add_comment($slug) {
        $article = Blog::where('slug', $slug)->first();
        $validator = \Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return redirect("{$article->url}#comment-form")->withErrors($validator)->withInput();
        }
        $user = User::where('id', $article->user_id)->first();
        if(auth()->id() !== $user->id) {
            Notification::send($user, new NewComments($article, request()->all()));
        }
        Comment::create(request()->all());
        return redirect("{$article->url}")->with('success', "Le commentaire a bien été ajouté");
    }

    public function delete_comment($slug, $id)
    {
        $article = Blog::where('slug', $slug)->first();
        $comment = Comment::where('id', $id)->first();
        $comment->delete();
        return redirect($article->url)->with('success', "Le commentaire a bien été supprimé");
    }
}
