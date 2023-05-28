<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $list = User::_list();
        if (!$list) {
            return view('backend.system.404');
        } else {
            return view('backend.user.list', ['collection' => $list]);
        }
    }

    public function login()
    {
        //----------Check Login----------//
        $check_login = Auth::check();
        if (!$check_login) {
            return view('backend.user.login');
        } else {
            return redirect()->route('b.home');
        }
    }

    public function loginPost(Request $request)
    {
        //----------Check Validate Data----------//
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        //----------Check Input Data----------//
        $cre = ['username' => $request->username, 'password' => $request->password, 'status' => 1];
        $check = Auth::attempt($cre, $request->remember);
        if ($check) {
            return redirect()->route('b.home');
        } else {
            return redirect()->route('b.login')
                ->with([
                    'msg' => 'Incorrect Username or Password',
                    'type' => 'danger'
                ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('b.login')
            ->with([
                'msg' => 'You Have Logout this System',
                'type' => 'Warning'
            ]);
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function create_action(Request $request)
    {
        //----------Check Validate Data----------//
        $request->validate([
            'add_username' => 'required',
            'add_password' => 'required',
            'add_email' => 'required|email',
            'add_phone' => 'numeric'
        ]);
        //----------Check Username Exist----------//
        $user = User::_checkuser($request->add_username);
        if (!$user) {
            //----------Insert Database User----------//
            $new = User::create();
            $new->name = trim($request->add_name);
            $new->username = trim($request->add_username);
            $new->image = $request->image;
            $new->password = Hash::make($request->add_password);
            $new->email = trim($request->add_email);
            $new->phone = trim($request->add_phone);
            $new->group_id = trim($request->add_group);
            $new->status = 1;
            $new->save();

            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'Created User Success',
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('b.createuser')
                ->with([
                    'msg' => 'Username  Exist',
                    'type' => 'danger'
                ]);
        }
    }

    public function edit($id)
    {
        //----------Check ID----------//
        if (!$id) {
            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'User ID: ' . $id . ' No Exist',
                    'type' => 'danger'
                ]);
        }
        //----------Check ID ADMIN----------//
        if ($id == 51) {
            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'This User ID: ' . $id . ' Cant Edit',
                    'type' => 'danger'
                ]);
        }
        $user = User::_item($id);
        if ($user) {
            return view('backend.user.edit', ['user' => $user]);
        } else {
            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'User No Exist',
                    'type' => 'danger'
                ]);
        }
    }

    public function edit_update(Request $request, $id)
    {
        //----------Check Validate Data----------//
        $request->validate([
            'edit_phone' => 'numeric'
        ]);

        //----------Check User----------//
        if (!$id) {
            redirect()->route('b.userlist')
                ->with([
                    'msg' => 'User ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        } else {
            $user = User::_item($id);
            if ($update = User::_update(
                $id,
                $user->name,
                $request->edit_name,
                $user->image,
                $request->image,
                $user->phone,
                $request->edit_phone,
                $user->status,
                $request->edit_status,
                $user->group_id,
                $request->edit_group
            )) {
                return redirect()->route('b.infouser', $id)
                    ->with([
                        'msg' => ' Update User ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('b.infouser', $id)
                    ->with([
                        'msg' => ' Update User ID: ' . $id . ' Fail',
                        'type' => 'danger'
                    ]);
            }
        }
    }

    public function profile($id)
    {
        //----------Check ID----------//
        if (!$id) {
            return redirect()->route('b.home');
        }
        //----------Check ID ADMIN----------//
        if ($id == 51) {
            return redirect()->route('b.home');
        }
        $user = User::_item($id);
        if ($user) {
            return view('backend.user.profile', ['user' => $user]);
        } else {
            return redirect()->route('b.home');
        }
    }

    public function profile_update(Request $request, $id)
    {
        //----------Check Validate Data----------//
        $request->validate([
            'edit_phone' => 'numeric'
        ]);

        //----------Check User----------//
        if (!$id) {
            redirect()->route('b.home');
        } else {
            $user = User::_item($id);
            if ($update = User::_update(
                $id,
                $user->name,
                $request->edit_name,
                $user->image,
                $request->image,
                $user->phone,
                $request->edit_phone,
                $user->status,
                $request->edit_status,
                $user->group_id,
                $request->edit_group
            )) {
                return redirect()->route('b.infouser', $id)
                    ->with([
                        'msg' => ' Update User ID: ' . $id . ' Success',
                        'type' => 'success'
                    ]);
            } else {
                return redirect()->route('b.infouser', $id)
                    ->with([
                        'msg' => ' Update User ID: ' . $id . ' Fail',
                        'type' => 'danger'
                    ]);
            }
        }
    }

    public function delete($id)
    {
        //----------Check ID----------//
        if (!$id) {
            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'User ID: ' . $id . ' No Exist',
                    'type' => 'danger'
                ]);
        }
        //----------Check ID ADMIN----------//
        if ($id == 51) {
            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'This User ID: ' . $id . ' Cant Delete',
                    'type' => 'danger'
                ]);
        }
        //----------//
        $user = User::_delete($id);
        if ($user) {
            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'Delete Success User ID: ' . $id,
                    'type' => 'success'
                ]);
        } else {
            return redirect()->route('b.userlist')
                ->with([
                    'msg' => 'Delete Fail User ID: ' . $id,
                    'type' => 'danger'
                ]);
        }
    }
}
