<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;

class BlogController extends AdminController
{

    public function authorized() {
        if(!auth()->check()) {
            return abort(404);
        }
        if(!auth()->user()->isAdmin()) {
            return abort(404);
        }
    }

    public function index()
  {
    $articles = Blog::with('user', 'comments')->get();
    return view('admin.articles.index', compact('articles'));
  }

  public function destroy($id)
  {
      $articles = Blog::with('user')->where('id', $id)->first();
      $user = $articles->user;
      if($user || $user->isAdmin()) {
          $articles->delete();
          return redirect()->back();
      }
  }

  public function delete_all()
  {
      $articles = Blog::truncate();
      $articles->delete();
      return redirect()->back();
  }
}
