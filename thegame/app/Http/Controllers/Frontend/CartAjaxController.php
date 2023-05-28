<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Aws\S3\Enum\Status;
use Illuminate\Http\Request;

class CartAjaxController extends Controller
{
    public function index()
    {
        $cart = session('cart');
        return view('frontend.order.cart', ['list' => $cart, 'total' => 0]);
    }

    public function addToCart($id)
    {
        //----------Check Product Id----------
        if ($id < 1 || !is_numeric($id))
            return response()->json(['status' => 'danger', 'msg' => 'Data Incorrect']);
        //----------Check Product----------//
        $product = Product::_itemprod($id);
        if (!$product)
            return response()->json(['status' => 'danger', 'msg' => 'Product No Existing']);
        //----------Add To Cart----------//
        if (!$product->qty)
            return response()->json(['status' => 'danger', 'msg' => '"' . $product->name . '"' . ' Out Stock']);

        $cart = session('cart');
        if (isset($cart[$product->id])) {
            //----------Product Existing----------
            $cart[$product->id]['buyqty']++;
            $subtotal = collect($cart)->sum(function (array $item) {
                return $item['buyqty'] * $item['price'];
            });
        } else {
            //---------Product Don't Existing----------//
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'qty' => $product->qty,
                'buyqty' => 1,
                'price' => $product->price
            ];
            $subtotal = collect($cart)->sum(function (array $item) {
                return $item['buyqty'] * $item['price'];
            });
        }
        //----------Update Session----------//
        session(['cart' => $cart]);
        return response()->json([
            'status' => 'success',
            'msg' => '"' . $product->name . '"' . ' Already Add To Cart Success',
            'subtotal' => '$' . number_format($subtotal, 2),
            'countitem' => count($cart)
        ]);
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session('cart');
        if ($cart && $request->qty && isset($cart[$id]) && $request->qty <= $cart[$id]['qty'] && $request->qty > 0) {
            $cart[$id]['buyqty'] = $request->qty;
            session(['cart' => $cart]);
            $subtotal = collect($cart)->sum(function (array $item) {
                return $item['buyqty'] * $item['price'];
            });
            return response()->json([
                'status' => 'success',
                'countitem' => count($cart),
                'amount' => '$' . number_format($request->qty * $cart[$id]['price'], 2),
                'subtotal' => '$' . number_format($subtotal, 2),
                'total' => '$' . number_format($subtotal, 2)
            ]);
        } else {
            return response()->json(['status' => 'danger', 'msg' => 'Data Incorrect']);
        }
    }

    public function removeItemCart($id)
    {
        $cart = session('cart');
        //----------Check----------//
        if (isset($cart[$id])) {
            $product = Product::_itemprod($id);
            if (count($cart) > 0) {
                //----------Item exist----------//
                unset($cart[$id]);
                session(['cart' => $cart]);
                $subtotal = collect($cart)->sum(function (array $item) {
                    return $item['buyqty'] * $item['price'];
                });
            }
            return response()->json([
                'status' => 'success',
                'msg' => '"' . $product->name . '"' . ' Already Delete Form Cart',
                'countitem' => count($cart),
                'subtotal' => '$' . number_format($subtotal, 2),
                'total' => '$' . number_format($subtotal, 2)
            ]);
        }
    }

    public function removeAllItemCart()
    {
        $cart = session('cart');
        //----------Check----------//
        if (isset($cart)) {
            //----------Item exist----------//
            session()->forget('cart');
        }
        return response()->json(['status' => 'success']);
    }
}
