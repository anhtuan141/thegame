<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {
        $hot = Product::_hot();

        $game = Product::_game();

        $console = Product::_console();

        $coming = Product::_coming(3);

        $rate = Product::_rate(3);

        $sale = Product::_sale(3);

        $preorder = Product::_preorder();

        $blog = Article::_list(3);

        return view('frontend.system.index', [
            'collection' => $hot,
            'collection1' => $game,
            'collection2' => $console,
            'collection4' => $coming,
            'collection5' => $rate,
            'collection6' => $sale,
            'collection7' => $blog,
            'collection8' => $preorder,
        ]);
    }

    public function search(Request $request)
    {
        $key = "%" . $request->search . "%";

        $game = Product::_search($key, 'game', 4);

        $console = Product::_search($key, 'console', 4);

        $blog = Article::_search($key, 4);
        return view('frontend.system.search', [
            'collection' => $game,
            'collection1' => $console,
            'collection2' => $blog
        ]);
    }

    public function _404()
    {
        return view('frontend.system.404');
    }
}