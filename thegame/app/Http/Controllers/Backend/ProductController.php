<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Product::_list();
        return view('backend.product.list', ['collection' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //----------Check Validate Data----------//
        $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'supplier' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);
        //----------Check Product Name Exist----------//
        $prod = Product::_checkprod($request->alias);
        if (!$prod) {
            //----------Insert Database User----------//
            $new = Product::create();
            $new->name = trim($request->name);
            $new->alias = trim($request->alias);
            $new->image = $request->image;
            $new->supplier_id = trim($request->supplier);
            $new->category_id = trim($request->category);
            $new->platforms = trim($request->platforms);
            $new->kind = trim($request->kind);
            $new->price = trim($request->price);
            $new->qty = trim($request->qty);
            $new->desc = $request->description;
            $new->status = 1;
            $new->save();

            return redirect()->route('products.index')
                ->with([
                    'msg' => 'Created Product Success',
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('products.create')
                ->with([
                    'msg' => 'Product ' . '"' . $request->name . '"' . ' Exist',
                    'type' => 'danger'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //----------Check ID----------//
        if (!$id) {
            return redirect()->route('products.index')
                ->with(
                    [
                        'msg' => 'Product ID: ' . $id . ' No exist',
                        'type' => 'danger'
                    ]
                );
        }

        $prod = Product::_item($id);
        if ($prod) {
            return view('backend.product.edit', ['prod' => $prod]);
        } else {
            return redirect()->route('products.index')->with(
                [
                    'msg' => 'Product No Exist',
                    'type' => 'danger'
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //----------Check Validate Data----------//
        $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'supplier' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        //----------Check Blog----------//
        if (!$id) {
            redirect()->route('products.index')
                ->with([
                    'msg' => 'Product ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        } else {
            $prod = Product::_item($id);
            if ($prod = Product::_update(
                $id,
                $prod->name,
                $request->name,
                $prod->alias,
                $request->alias,
                $prod->image,
                $request->image,
                $prod->supplier_id,
                $request->supplier,
                $prod->category_id,
                $request->category,
                $prod->platforms,
                $request->platforms,
                $prod->kind,
                $request->kind,
                $prod->price,
                $request->price,
                $prod->qty,
                $request->qty,
                $prod->desc,
                $request->description,
                $prod->status,
                $request->status
            )) {
                return redirect()->route('products.edit', $id)
                    ->with([
                        'msg' => ' Update Product ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('products.edit', $id)
                    ->with([
                        'msg' => ' Update Product ID: ' . $id . ' Fail',
                        'type' => 'danger'
                    ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //----------Check ID----------//
        if (!$id) {
            return redirect()->route('products.index')
                ->with([
                    'msg' => 'Product ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }
        //----------//
        $user = Product::_delete($id);
        if ($user) {
            return redirect()->route('products.index')
                ->with([
                    'msg' => 'Delete Success Product ID: ' . $id,
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('products.index')
                ->with([
                    'msg' => 'Delete Fail Product ID: ' . $id,
                    'type' => 'danger'
                ]);
        }
    }
}
