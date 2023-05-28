<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function shop()
    {
        $list = Product::_shop(16);
        $all = Product::all();
        if ($list) {
            return view('frontend.product.shop', ['collection' => $list, 'all' => $all]);
        } else {
            return redirect()->route('f.home');
        }
    }

    public function detail($a)
    {
        $item = Product::_detail($a);
        if ($item) {
            return view('frontend.product.detail', ['collection' => $item]);
        } else {
            return redirect()->route('f._404');
        }
    }
}
