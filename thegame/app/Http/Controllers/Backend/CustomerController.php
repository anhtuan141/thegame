<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Customer::_list();
        return view('backend.customer.list', ['collection' => $list]);
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
        $cus = Customer::_item($id);
        $list = Customer::_customer_order($id);
        return view('backend.customer.customer_order', ['collection' => $list, 'cus' => $cus]);
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
            return redirect()->route('customers.index')
                ->with([
                    'msg' => 'Customer ID: ' . $id . ' No Exist',
                    'type' => 'danger'
                ]);
        }

        $customer = Customer::_item($id);
        if ($customer) {
            return view('backend.customer.edit', ['customer' => $customer]);
        } else {
            return redirect()->route('customers.index')
                ->with([
                    'msg' => 'Customer No Exist',
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
            'edit_phone' => 'numeric'
        ]);

        //----------Check User----------//
        if (!$id) {
            redirect()->route('customers.index')
                ->with([
                    'msg' => 'Customer ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        } else {
            $customer = Customer::_item($id);
            if ($update = Customer::_update(
                $id,
                $customer->name,
                $request->name,
                $customer->address,
                $request->address,
                $customer->phone,
                $request->phone,
                $customer->status,
                $request->status
            )) {
                return redirect()->route('customers.edit', $id)
                    ->with([
                        'msg' => ' Update Customer ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('customers.edit', $id)
                    ->with(
                        [
                            'msg' => ' Update Customer ID: ' . $id . ' Fail',
                            'type' => 'danger'
                        ]
                    );
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
