<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('frontend.index') ;
    }

    public function detail(Request $request, $slug)
    {
        return view('frontend.detail');
    }
}
