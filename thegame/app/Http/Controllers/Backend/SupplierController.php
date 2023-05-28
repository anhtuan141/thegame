<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Supplier::_list();
        return view('backend.supplier.list', ['collection' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.supplier.create');
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
        ]);
        //----------Check Username Exist----------//
        $supp = Supplier::_checksupp($request->alias);
        if (!$supp) {
            //----------Insert Database User----------//
            $new = Supplier::create();
            $new->name = trim($request->name);
            $new->alias = trim($request->alias);
            $new->image = $request->image;
            $new->desc = $request->description;
            $new->title = $request->title;
            $new->status = 1;
            $new->save();

            return redirect()->route('suppliers.index')
                ->with([
                    'msg' => 'Created Supplier Success',
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('suppliers.create')
                ->with([
                    'msg' => 'Supplier  Exist',
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
            return redirect()->route('suppliers.index')
                ->with([
                    'msg' => 'Supplier ID: ' . $id . ' No Exist',
                    'type' => 'danger'
                ]);
        }

        $supp = Supplier::_item($id);
        if ($supp) {
            return view('backend.supplier.edit', ['supp' => $supp]);
        } else {
            return redirect()->route('suppliers.index')
                ->with([
                    'msg' => 'User No Exist',
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
        ]);

        //Check Supplier
        if (!$id) {
            redirect()->route('suppliers.index')
                ->with([
                    'msg' => 'Supplier ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        } else {
            $supp = Supplier::_item($id);
            if ($update = Supplier::_update(
                $id,
                $supp->name,
                $request->name,
                $supp->alias,
                $request->alias,
                $supp->image,
                $request->image,
                $supp->desc,
                $request->description,
                $supp->title,
                $request->title,
                $supp->status,
                $request->status,
            )) {
                return redirect()->route('suppliers.edit', $id)
                    ->with([
                        'msg' => ' Update Supplier ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('suppliers.edit', $id)
                    ->with([
                        'msg' => ' Update Supplier ID: ' . $id . ' Fail',
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
            return redirect()->route('')
                ->with([
                    'msg' => 'Product ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }
        //----------//
        $user = Supplier::_delete($id);
        if ($user) {
            return redirect()->route('suppliers.index')
                ->with([
                    'msg' => 'Delete Success Supplier ID: ' . $id,
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('suppliers.index')
                ->with([
                    'msg' => 'Delete Fail Supplier ID: ' . $id,
                    'type' => 'danger'
                ]);
        }
    }
}
