<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function index()
    {
        return view('backend.system.index');
    }

    public function _404()
    {
        return view('backend.system.404');
    }

    public function _403()
    {
        return view('backend.system.403');
    }
}
