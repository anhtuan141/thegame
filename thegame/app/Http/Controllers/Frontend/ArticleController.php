<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $news = Article::_recent_new();
        view()->share('news', $news);
    }

    public function index()
    {
        $list = Article::_list(6);
        if ($list) {
            return view('frontend.article.index', ['collection' => $list]);
        } else {
            return redirect()->route('f._404');
        }
    }
    public function detail($id)
    {
        $blog = Article::_item($id);
        if ($blog) {
            return view('frontend.article.detail', ['collection' => $blog]);
        } else {
            return redirect()->route('f._404');
        }
    }
}
