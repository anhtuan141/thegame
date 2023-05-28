<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Func;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = User::_list();
        return view('backend.role.list', ['collection' => $list]);
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
        $funcs = $request->post('funcs', []);
        $user_id = $request->user_id;
        if (!$user_id) {
            return redirect()->route('roles.index');
        } else {
            //----------Recall Permission----------//
            $recall = Role::_recallPermission($user_id);
            //----------Grand New Permission----------//
            foreach ($funcs as $func) {
                $grand = Role::_grandPermission($user_id, $func);
            }
            return redirect()->route('roles.edit', $user_id)
                ->with([
                    'msg' => 'Permissions update successful',
                    'type' => 'success'
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
        //----------Check ID Exist----------//
        if (!$id) {
            return redirect()->route('roles.index')
                ->with([
                    'msg' => 'ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }
        // if ($id == 51) {
        //     return redirect()->route('roles.index')
        //         ->with([
        //             'msg' => 'This ID: ' . $id . ' cant permission',
        //             'type' => 'danger'
        //         ]);
        // }
        //----------//
        $user = User::_itemuser($id);
        //----------Check User----------//
        if (!$user) {
            return  redirect()->route('roles.index')
                ->with([
                    'msg' => 'User ID: ' . $id . ' no exist',
                    'type' => 'danger'
                ]);
        }

        $role = new Role();
        $parentlist = Func::_listfunction();
        return view('backend.role.role_list', [
            'user' => $user,
            'parentlist' => $parentlist,
            'role' => $role,
        ]);
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
        //
    }
}
