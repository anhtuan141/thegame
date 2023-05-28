<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $cart = session('cart');
        if ($cart) {
            return view('frontend.order.checkout', ['list' => $cart, 'total' => 0]);
        } else {
            return redirect()->route('f._404');
        }
    }

    public function add_order(Request $request)
    {
        $cart = session('cart');
        //----------Total----------//
        $total = 0;
        foreach ($cart as $item) {
            $amount = $item['price'] * $item['buyqty'];
            $total += $amount;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        //----------Check Login----------//
        $check_user = Auth::guard('frontend')->check();
        if (!$check_user) {
            //----------Check Validate Data----------//
            $request->validate([
                'name2' => 'required',
                'email2' => 'required|email',
                'phone2' => 'required|numeric',
                'address2' => 'required'
            ]);
            //----------Check Customer Exist----------//
            if (!Customer::_checkcustomer($request->email2)) {
                //----------Insert Database Customers----------//
                $customer = Customer::create();
                $customer->name = $request->name2;
                $customer->email = $request->email2;
                $customer->phone = $request->phone2;
                $customer->address = $request->address2;
                $customer->status = -1;
                $customer->save();
                //----------Insert Database Orders----------//
                $order = Order::create();
                $order->customer_id = $customer->id;
                $order->code = date('ymdHis') . '-' . $customer->id;
                $order->order_status = 1;
                $order->total = $total;
                $order->sustotal = $total;
                $order->address_ship = $request->address2;
                $order->note = $request->order_note;
                $order->save();
                if ($order) {
                    //----------Insert Database Order_details----------//
                    foreach ($cart as $item) {
                        $order_detail = OrderItem::create();
                        $order_detail->order_id = $order->id;
                        $order_detail->product_id = $item['id'];
                        $order_detail->qty = $item['buyqty'];
                        $order_detail->price = $item['price'];
                        $order_detail->save();
                    }
                    return redirect()->route('f.success_order', $order->id)
                        ->with([
                            'email' => trim($request->email2),
                            'name' => trim($request->name2)
                        ]);
                } else {
                    return redirect()->route('f.shopcart')->with([
                        'type' => 'danger',
                        'msg' => 'ORDER FAIL'
                    ]);
                }
            } else {
                //----------Get ID Customer----------//
                $cus_id = Customer::_customer($request->email2);
                //----------Insert Database Orders----------//
                $order = Order::create();
                $order->customer_id = $cus_id->id;
                $order->code = date('ymdHis') . '-' . $cus_id->id;
                $order->order_status = 1;
                $order->total = $total;
                $order->sustotal = $total;
                $order->address_ship = $request->address2;
                $order->note = $request->order_note;
                $order->save();
                if ($order) {
                    //----------Insert Database Order_details----------//
                    foreach ($cart as $item) {
                        $order_detail = OrderItem::create();
                        $order_detail->order_id = $order->id;
                        $order_detail->product_id = $item['id'];
                        $order_detail->qty = $item['buyqty'];
                        $order_detail->price = $item['price'];
                        $order_detail->save();
                        //----------Update Quantity Product----------//
                        $prod_qty = Product::_item($item['id']);
                        $new_qty = Product::_updateQty($item['id'], $prod_qty->qty, $item['buyqty']);
                    }
                    return redirect()->route('f.success_order', $order->id)
                        ->with([
                            'email' => trim($request->email2),
                            'name' => trim($request->name2)
                        ]);
                } else {
                    return redirect()->route('f.shopcart')->with([
                        'type' => 'danger',
                        'msg' => 'ORDER FAIL'
                    ]);
                }
            }
        } else {
            //----------Check Ship To A Different Address----------//
            if (!$request->cus_orther) {
                //----------Insert Database Orders----------//
                $order = Order::create();
                $order->customer_id = auth('frontend')->user()->id;
                $order->code = date('ymdHis') . '-' . auth('frontend')->user()->id;
                $order->order_status = 1;
                $order->total = $total;
                $order->sustotal = $total;
                $order->address_ship = auth('frontend')->user()->address;
                $order->note = $request->order_note;
                $order->save();
                if ($order) {
                    //----------Insert Database Order_details----------//
                    foreach ($cart as $item) {
                        $order_detail = OrderItem::create();
                        $order_detail->order_id = $order->id;
                        $order_detail->product_id = $item['id'];
                        $order_detail->qty = $item['buyqty'];
                        $order_detail->price = $item['price'];
                        $order_detail->save();
                        //----------Update Quantity Product----------//
                        $prod_qty = Product::_item($item['id']);
                        $new_qty = Product::_updateQty($item['id'], $prod_qty->qty, $item['buyqty']);
                    }
                    return redirect()->route('f.success_order', $order->id)
                        ->with([
                            'email' => auth('frontend')->user()->email,
                            'name' => auth('frontend')->user()->name
                        ]);
                } else {
                    return redirect()->route('f.shopcart')
                        ->with([
                            'type' => 'danger',
                            'msg' => 'ORDER FAIL'
                        ]);
                }
            } else {
                //----------Check Validate Data----------//
                $request->validate([
                    'name_dif' => 'required',
                    'email_dif' => 'required|email',
                    'phone_dif' => 'required|numeric',
                    'address_dif' => 'required'
                ]);
                //----------Check Customer Exist----------//
                if (!Customer::_checkcustomer($request->email_dif)) {
                    //Insert Database Customers
                    $customer = Customer::create();
                    $customer->name = $request->name_dif;
                    $customer->email = $request->email_dif;
                    $customer->phone = $request->phone_dif;
                    $customer->address = $request->address_dif;
                    $customer->status = -1;
                    $customer->save();
                    //Insert Database Orders
                    $order = Order::create();
                    $order->customer_id = $customer->id;
                    $order->code = date('ymdHis') . '-' . $customer->id;
                    $order->order_status = 1;
                    $order->total = $total;
                    $order->sustotal = $total;
                    $order->address_ship = $request->address_dif;
                    $order->note = $request->order_note;
                    $order->save();
                    if ($order) {
                        //Insert Database Order_details
                        foreach ($cart as $item) {
                            $order_detail = OrderItem::create();
                            $order_detail->order_id = $order->id;
                            $order_detail->product_id = $item['id'];
                            $order_detail->qty = $item['buyqty'];
                            $order_detail->price = $item['price'];
                            $order_detail->save();
                            //----------Update Quantity Product----------//
                            $prod_qty = Product::_item($item['id']);
                            $new_qty = Product::_updateQty($item['id'], $prod_qty->qty, $item['buyqty']);
                        }
                        return redirect()->route('f.success_order', $order->id)
                            ->with([
                                'email' => trim($request->email_dif),
                                'name' => trim($request->name_dif)
                            ]);
                    } else {
                        return redirect()->route('f.shopcart')->with([
                            'type' => 'danger',
                            'msg' => 'ORDER FAIL'
                        ]);
                    }
                } else {
                    //----------Get ID Customer----------//
                    $cus_id = Customer::_customer($request->email_dif);
                    //----------Insert Database Orders----------//
                    $order = Order::create();
                    $order->customer_id = $cus_id->id;
                    $order->code = date('ymdHis') . '-' . $cus_id->id;
                    $order->order_status = 1;
                    $order->total = $total;
                    $order->sustotal = $total;
                    $order->address_ship = $request->address_dif;
                    $order->note = $request->order_note;
                    $order->save();
                    if ($order) {
                        //----------Insert Database Order_details----------//
                        foreach ($cart as $item) {
                            $order_detail = OrderItem::create();
                            $order_detail->order_id = $order->id;
                            $order_detail->product_id = $item['id'];
                            $order_detail->qty = $item['buyqty'];
                            $order_detail->price = $item['price'];
                            $order_detail->save();
                            //----------Update Quantity Product----------//
                            $prod_qty = Product::_item($item['id']);
                            $new_qty = Product::_updateQty($item['id'], $prod_qty->qty, $item['buyqty']);
                        }
                        return redirect()->route('f.success_order', $order->id)
                            ->with([
                                'email' => auth('frontend')->user()->email,
                                'name' => auth('frontend')->user()->name,
                                'code' => $order->code,
                                'total' => $order->total,
                                'address_ship' => $order->address_ship,
                                'note' => $order->note
                            ]);
                    } else {
                        return redirect()->route('f.shopcart')->with([
                            'type' => 'danger',
                            'msg' => 'ORDER FAIL'
                        ]);
                    }
                }
            }
        }
    }

    public function success(Request $request, $id)
    {
        $cart = session('cart');
        if ($cart) {
            //----------Send Mail----------//
            if (session('email') && session('name')) {
                Mail::send('order-mail', [
                    'name' => session('name'),

                ], function ($message) use ($request) {
                    $message->to(session('email'), session('name'));
                    $message->subject('Thank You For Your Purchase');
                });
            }

            //----------Clear cart after checkout----------//
            session()->forget('cart');
            $item = Order::_item($id);
            return view('frontend.order.success', ['item' => $item]);
        } else {
            return redirect()->route('f._404');
        }
    }

    public function order_status($id)
    {
        $list = Order::_list_order_status($id, 10);
        if ($list) {
            return view('frontend.order.order_status', ['list' => $list]);
        } else {
            return view('frontend.system.404');
        }
    }

    public function order_detail($id)
    {
        $list = OrderItem::_list($id);
        if ($list) {
            return view('frontend.order.order_detail', ['list' => $list]);
        } else {
            return view('frontend.system.404');
        }
    }
}