<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{

    public function cate_pro($id)
    {
        //----------Category----------//
        $cate = Category::_item($id);

        //----------List Product For Each Category----------//
        $list = Product::_cate_prod($id);

        //----------//
        if ($list && $cate) {
            return view('frontend.category.index', ['collection' => $list, 'cate' => $cate]);
        } else {
            return redirect()->route('f._404');
        }
    }
}
