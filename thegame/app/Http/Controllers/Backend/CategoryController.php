<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::_list();
        return view('backend.category.list', ['collection' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'parent_id' => 'required'
        ]);
        //----------Check Product Name Exist----------//
        $cate = Category::_checkcate($request->alias);
        if (!$cate) {
            //----------Insert Database User----------//
            $new = Category::create();
            $new->name = trim($request->name);
            $new->alias = trim($request->alias);
            $new->parent_id = trim($request->parent_id);
            $new->status = 1;
            $new->save();

            return redirect()->route('categories.index')
                ->with([
                    'msg' => 'Created Category Success',
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('categories.create')
                ->with([
                    'msg' => 'Category: ' . '"' . $request->name . '"' . ' Already Exist',
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
            return redirect()->route('categories.index')
                ->with([
                    'msg' => 'Category ID: ' . $id . ' No Exist',
                    'type' => 'danger'
                ]);
        }

        $cate = Category::_item($id);
        if ($cate) {
            return view('backend.category.edit', ['cate' => $cate]);
        } else {
            return redirect()->route('categories.index')
                ->with([
                    'msg' => 'Category No Exist',
                    'type' => 'danger'
                ]);
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
            'parent_id' => 'required'
        ]);

        //----------Check Blog----------//
        if (!$id) {
            redirect()->route('categories.index')
                ->with([
                    'msg' => 'Category ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        } else {
            $cate = Category::_item($id);
            if ($update = Category::_update(
                $id,
                $cate->name,
                $request->name,
                $cate->alias,
                $request->alias,
                $cate->parent_id,
                $request->parent_id,
                $cate->status,
                $request->status
            )) {
                return redirect()->route('categories.edit', $id)
                    ->with([
                        'msg' => ' Update Category ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('categories.edit', $id)
                    ->with([
                        'msg' => ' Update Category ID: ' . $id . ' Fail',
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
            return redirect()->route('categories.index')
                ->with([
                    'msg' => 'Category ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }
        //----------//
        $cate = Category::_delete($id);
        if ($cate) {
            return redirect()->route('categories.index')
                ->with([
                    'msg' => 'Delete Success Category ID: ' . $id,
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('categories.index')
                ->with([
                    'msg' => 'Delete Fail Category ID: ' . $id,
                    'type' => 'danger'
                ]);
        }
    }
}
