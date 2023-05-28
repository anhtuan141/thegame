<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ArticleGroup;
use Illuminate\Http\Request;

class ArticleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = ArticleGroup::_list();
        return view('backend.article_group.list', ['collection' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.article_group.create');
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
        $cate = ArticleGroup::_checkcate($request->alias);
        if (!$cate) {
            //----------Insert Database User----------//
            $new = ArticleGroup::create();
            $new->name = trim($request->name);
            $new->alias = trim($request->alias);
            $new->parent_id = trim($request->parent_id);
            $new->status = 1;
            $new->save();

            return redirect()->route('articlegroups.index')
                ->with([
                    'msg' => 'Created Category Success',
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('articlegroups.create')
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
            return redirect()->route('articlegroups.index')
                ->with([
                    'msg' => 'Category ID: ' . $id . ' No Exist',
                    'type' => 'danger'
                ]);
        }

        $cate = ArticleGroup::_item($id);
        if ($cate) {
            return view('backend.article_group.edit', ['cate' => $cate]);
        } else {
            return redirect()->route('articlegroups.index')
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
            redirect()->route('articlegroups.index')
                ->with([
                    'msg' => 'Category ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        } else {
            $cate = ArticleGroup::_item($id);
            if ($update = ArticleGroup::_update(
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
                return redirect()->route('articlegroups.edit', $id)
                    ->with([
                        'msg' => ' Update Category ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('articlegroups.edit', $id)
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
            return redirect()->route('articlegroups.index')
                ->with([
                    'msg' => 'Category ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }
        //----------//
        $cate = ArticleGroup::_delete($id);
        if ($cate) {
            return redirect()->route('articlegroups.index')
                ->with([
                    'msg' => 'Delete Success Category ID: ' . $id,
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('articlegroups.index')
                ->with([
                    'msg' => 'Delete Fail Category ID: ' . $id,
                    'type' => 'danger'
                ]);
        }
    }
}
