<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Notifications\NewArticles;
use App\Setting;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Notification;

class PagesController extends AdminController
{

    public function authorized() {
        if(!auth()->check()) {
            return abort(404);
        }
        if(!auth()->user()->isAdmin()) {
            return abort(404);
        }
    }

    public function index() {
        $this->authorized();
        $articles = Blog::with('comments', 'user')->get();
        $comments = Comment::with('blog')->get();
        return view('admin.pages.index', ['articles' => $articles, 'comments' => $comments]);
    }

    public function create() {
        $this->authorized();
        $article = new Blog();
        return view('admin.articles.create', ['article' => $article]);
    }

    public function store() {
        $validator = \Validator::make(request()->all(), [
            'name' => 'required|max:30|min:3',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::all();
        $article = Blog::create(request()->all());
        Notification::send($user, new NewArticles($article));
        return redirect()->route('admin.index');
    }

    public function edit($id) {
        $this->authorized();
        $article = Blog::where('id', $id)->first();
        return view('admin.articles.create', ['article' => $article]);
    }

    public function update($id) {
        $article = Blog::findOrFail($id);
        $validator = \Validator::make(request()->all(), [
            'name' => 'required|max:30|min:10',
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $article->updated_at = date(now());
        $article->update(request()->all());
        return redirect()->route('admin.index');
    }

    public function UpdateSettings($id)
    {
        $this->authorized();
        return Setting::where('id', $id)->first();
    }

    public function settings()
    {
        $settings = $this->UpdateSettings(1);
        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function create_settings()
    {
        $settings = $this->Updatesettings(1);
        $validator = \Validator::make(request()->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $settings->update(request()->all());
        return redirect()->back()->with('success', "Les paramètres ont bien été sauvegarder");
    }
}
