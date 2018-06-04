<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard');
    }

    public function settings()
    {
        return view('settings');
    }

    public function calls()
    {
        return view('calls');
    }

    public function leads()
    {
        return view('leads');
    }
}
