<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if(request()->ajax()){
        $query = Products::query();
        return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                <a href="' . route('dashboard.product.gallery.index', $item->id) . '" class="bg-green-400 hover:bg-green-700 text-white font-bold -my-3 py-2 px-4 rounded shadow-lg">Galery</a>
                <form class="inline-block" method="post" action="'. route('dashboard.product.destroy', $item->id). '">
                <a href="' . route('dashboard.product.edit', $item->id) . '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold -my-3 py-2 px-4 rounded shadow-lg">Edit</a>
                <form class="inline-block" method="post" action="'. route('dashboard.product.destroy', $item->id). '">
                ' . method_field('delete') . csrf_field() . '
                <button type="submit" class="h-10 px-4 text-sm text-red-100 transition-colors duration-150 bg-red-700 font-bold text-white rounded focus:shadow-outline hover:bg-red-800">Delete</button>
                </form>';
            })
            ->editColumn('price', function($item){
                return number_format($item->price);
            })
            ->rawColumns(['action'])
            ->make();
    }
    return view('pages.dashboard.product.index');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Products::create($data);
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('pages.dashboard.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Products $product)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product->update($data);
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        //
        $product->delete();
        return redirect()->route('dashboard.product.index');
    }
}
