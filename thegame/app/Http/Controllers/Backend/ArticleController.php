<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Article::_backend_list();
        return view('backend.article.list', ['collection' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.article.create');
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
            'image' => 'required',
            'category' => 'required',
            'summary' => 'required',
            'content1' => 'required'
        ]);
        //----------Check Product Name Exist----------//
        $blog = Article::_check_article($request->alias);
        if (!$blog) {
            //----------Insert Database User----------//
            $new = Article::create();
            $new->name = trim($request->name);
            $new->alias = trim($request->alias);
            $new->image = $request->image;
            $new->article_group_id = trim($request->category);
            $new->summary = $request->summary;
            $new->content = $request->content1;
            $new->status = 1;
            $new->save();

            return redirect()->route('articles.index')
                ->with([
                    'msg' => 'Created Blog Success',
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('articles.create')
                ->with([
                    'msg' => 'Blog: ' . '"' . $request->name . '"' . ' Already Exist',
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
            return redirect()->route('articles.edit')
                ->with([
                    'msg' => 'Blog ID: ' . $id . ' No Exist',
                    'type' => 'danger'
                ]);
        }

        $blog = Article::_item($id);
        if ($blog) {
            return view('backend.article.edit', ['blog' => $blog]);
        } else {
            return redirect()->route('articles.index')
                ->with([
                    'msg' => 'Blog No Exist',
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
            'category' => 'required',
            'image' => 'required'
        ]);

        //----------Check Blog----------//
        if (!$id) {
            redirect()->route('articles.index')
                ->with([
                    'msg' => 'Blog ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        } else {
            $blog = Article::_item($id);
            if ($update = Article::_update(
                $id,
                $blog->name,
                $request->name,
                $blog->alias,
                $request->alias,
                $blog->image,
                $request->image,
                $blog->article_group_id,
                $request->category,
                $blog->summary,
                $request->summary,
                $blog->content,
                $request->content1,
                $blog->status,
                $request->status
            )) {
                return redirect()->route('articles.edit', $id)
                    ->with([
                        'msg' => ' Update Blog ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('articles.edit', $id)
                    ->with([
                        'msg' => ' Update Blog ID: ' . $id . ' Fail',
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
            return redirect()->route('articles.index')
                ->with([
                    'msg' => 'Blog ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }
        //----------//
        $item = Article::_delete($id);
        if ($item) {
            return redirect()->route('articles.index')
                ->with([
                    'msg' => 'Delete Success Blog ID: ' . $id,
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('articles.index')
                ->with([
                    'msg' => 'Delete Fail Blog ID: ' . $id,
                    'type' => 'danger'
                ]);
        }
    }
}
