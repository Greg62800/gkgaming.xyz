<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index() {
        $articles = Blog::with('user', 'comments')->get();
        return view('home.index', ['articles' => $articles]);
    }
}
