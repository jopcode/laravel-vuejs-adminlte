<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Show the application
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.app');
    }
}
