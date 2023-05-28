<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function login()
    {
        //------------Check Login------------//
        $check_login = Auth::guard('frontend')->check();
        if (!$check_login) {
            return view('frontend.customer.login');
        } else {
            return redirect()->route('f.home');
        }
    }

    public function loginPost(Request $request)
    {
        //------------Check Validate Data-------------//
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //-------------Check Input Data------------//
        $cre = ['email' => $request->email, 'password' => $request->password, 'status' => 1];
        $check = Auth::guard('frontend')->attempt($cre, $request->remember);
        if ($check) {
            return redirect()->route('f.home');
        } else {
            return redirect()->route('f.login')
                ->with([
                    'type' => 'danger',
                    'msg' => 'Incorrect Email or Password'
                ]);
        }
    }

    public function logout()
    {
        Auth::guard('frontend')->logout();
        return redirect()->route('f.login')
            ->with([
                'type' => 'warning',
                'msg' => 'You Have Logged Out Of The System'
            ]);
    }

    public function create()
    {
        return view('frontend.customer.register');
    }

    public function create_action(Request $request)
    {
        //----------Check Validate Data----------//
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email',
        ]);
        //----------Check Username Exist----------//
        $customer = Customer::_checkcustomer($request->email);
        if (!$customer) {
            //----------Insert Database User----------//
            $new = Customer::create();
            $new->name = trim($request->name);
            $new->email = trim($request->email);
            $new->password = Hash::make($request->password);
            $new->status = 1;
            $new->save();

            return redirect()->route('f.login')
                ->with([
                    'msg' => 'Registerd Account Success',
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('f.register')
                ->with([
                    'msg' => 'Email Already Exist',
                    'type' => 'danger'
                ]);
        }
    }

    public function profile()
    {
        return view('frontend.customer.profile');
    }

    public function update_profile(Request $request, $id)
    {
        $cus_id = $id;
        if (!$cus_id) {
            return   redirect()->route('f.profile', auth('frontend')->user()->id);
        } else {
            if ($cus = Customer::_update(
                auth('frontend')->user()->id,
                auth('frontend')->user()->name,
                $request->name,
                auth('frontend')->user()->address,
                $request->address,
                auth('frontend')->user()->phone,
                $request->phone,
                auth('frontend')->user()->status,
                1
            )) {
                return   redirect()->route('f.profile', auth('frontend')->user()->id)
                    ->with([
                        'type' => 'success',
                        'msg' => 'Update Success'
                    ]);
            } else {
                return   redirect()->route('f.profile', auth('frontend')->user()->id)
                    ->with([
                        'type' => 'danger',
                        'msg' => 'Update Fail'
                    ]);
            }
        }
    }
}
