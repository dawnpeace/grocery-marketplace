<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AntarController extends Controller
{
    public function index()
    {
        return view('users.driver.dashboard');
    }
}
