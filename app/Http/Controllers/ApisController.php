<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApisController extends Controller
{
    public function index()
    {
        return view('apis.index');
    }
}
