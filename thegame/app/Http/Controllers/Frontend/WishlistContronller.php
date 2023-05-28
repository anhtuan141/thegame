<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistContronller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $create = Wishlist::_create($id, auth('frontend')->user()->id);

        if ($create) {
            return  redirect()->route('f.wishlist', auth('frontend')->user()->id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = Wishlist::_list($id);

        return view('frontend.wishlist.index', ['collection' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
            return redirect()->route('f.wishlist')
                ->with([
                    'msg' => 'Wishlist ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }
        //----------//
        $del = Wishlist::_delete($id);

        if ($del) {
            return  redirect()->route('f.wishlist', auth('frontend')->user()->id);
        } else {
            return view('frontend.system.404');
        }
    }
}
