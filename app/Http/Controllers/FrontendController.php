<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }
    //
    public function index(Request $request)
    {
        $products = Products::with(['gallery'])->latest()->where('deleted_at', null)->get();
        return view('pages.frontend.index', compact('products')) ;
    }

    public function detail(Request $request, $slug)
    {
        $product = Products::with(['gallery'])->where('slug', $slug)->firstOrFail();
        $recommendations = Products::with(['gallery'])->inRandomOrder()->limit(4)->get();
        return view('pages.frontend.detail', compact('product', 'recommendations'));
    }

    public function cart(Request $request)
    {
        return view('pages.frontend.cart');
    }

    public function success(Request $request)
    {
        return view('pages.frontend.success');
    }
}
