<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    //
    public function index(Request $request)
    {
        return view('pages.frontend.index') ;
    }

    public function detail(Request $request, $slug)
    {
        return view('pages.frontend.detail');
    }

    public function cart(Request $request)
    {
        return view('pages.frontend.cart');
    }

    public function success(Request $request)
    {
        return view('frontend.success');
    }
}
