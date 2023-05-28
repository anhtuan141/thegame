<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new = Order::_list_status(1);
        $confirm = Order::_list_status(2);
        $packing = Order::_list_status(3);
        $shipping = Order::_list_status(4);
        $success = Order::_list_status(5);
        $fail = Order::_list_status(6);
        $cancle = Order::_list_status(7);
        return view('backend.order.list', [
            'new' => $new,
            'confirm' => $confirm,
            'packing' => $packing,
            'shipping' => $shipping,
            'success' => $success,
            'fail' => $fail,
            'cancle' => $cancle,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if (!$id) {
            redirect()->route('orders.index')
                ->with([
                    'msg' => 'Order No Exist',
                    'type' => 'danger'
                ]);
        }

        //----------Order Item----------//
        $item = Order::_item($id);

        //----------Order Detail List----------//
        $detail = OrderItem::_list($id);
        if ($item && $detail) {
            return view('backend.order.edit', ['collection' => $detail, 'collection1' => $item]);
        } else {
            return redirect()->route('orders.index');
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
            'order_status' => 'required'
        ]);
        if (!$id) {
            redirect()->route('orders.index')
                ->with([
                    'msg' => 'Order No Exist',
                    'type' => 'danger'
                ]);
        } else {
            if ($update = Order::_update($id, $request->order_status)) {
                return redirect()->route('orders.index')
                    ->with([
                        'msg' => 'Order Status ' . $id . ' Update Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('orders.index')
                    ->with([
                        'msg' => 'Order Status ' . $id . ' Update Fail',
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
        //
    }
}
