<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Facade;

class BlogController extends Controller
{
    public function index() {
        $no_result = null;
        $last_comments = $this->findComment(3);
        if(request()->get('q')) {
            $blog = Blog::where('name', 'like', "%" . request()->get('q') . "%")->paginate(40);
            if(!$blog->count()) {
                $no_result = true;
                $blog = Blog::where('online', 1)->paginate(4);
            }
            return view('blog.index', ['blog' => $blog, 'no_result' => $no_result, 'comments' => $last_comments]);
        }else {
            $blog = Blog::where('online', 1)->paginate(4);
            return view('blog.index', ['blog' => $blog, 'no_result' => $no_result, 'comments' => $last_comments]);
        }
    }

    public function article() {
        $articles = Blog::with('user')->where('user_id', Auth::user()->id)->get();
        return view('blog.article', ['articles' => $articles]);
    }

    public function show($slug) {
        $article = Blog::with('comments')->where('slug', $slug)->first();
        $last_comments = $this->findComment(3);
        return view('blog.show', ['article' => $article, 'comments' => $last_comments]);
    }

    public function propose($id) {
        $article = Blog::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if($article) {
            $article->online = "1";
            $article->save();
            return back()->with('success', "L'article a bien été proposer");
        }else {
            return back()->with('error', "Cet article ne vous appartient pas");
        }
    }

    public function add_comment() {
        return back()->with('success', 'test');
    }

    public function category($category_name)
    {
        $cat = Category::where('name', $category_name)->first();
        $last_comments = $this->findComment(3);
        $blog = Blog::with('category', 'user', 'comments')->where('category_id', $cat->id)->paginate(5);
        return view('blog.category', ['blog' => $blog, 'category'=> $cat, 'comments' => $last_comments]);
    }


    public function category_post($cat, $article)
    {
        $category = Category::where('slug', $cat)->first();
        $last_comments = $this->findComment(3);
        $articles = Blog::with('category')->where('category_id', $category->id)->where('slug', $article)->first();
        return view('blog.category_post', ['article' => $articles, 'category' => $category, 'comments' => $last_comments]);
    }

    public function cats(Request $request)
    {
        $cat_name = request()->get('categories');
        $cat = Category::where('slug', $cat_name)->first();
        if($cat) {
            return redirect()->route('category.name', $cat->slug);
        }
        return redirect()->back()->status(404);
    }

    private function findComment(int $limit = 1)
    {
        $comment = new Comment;
        $comments = $comment->all()->take($limit);
        return $comments;
    }
}
