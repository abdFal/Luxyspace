<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()){
        $query = User::query();
        return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                <a href="' . route('dashboard.user.edit', $item->id) . '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold -my-3 py-2 px-4 rounded shadow-lg">Edit</a>
                <form class="inline-block" method="post" action="'. route('dashboard.product.destroy', $item->id). '">
                ' . method_field('delete') . csrf_field() . '
                <button type="submit" class="h-10 px-4 text-sm text-red-100 transition-colors duration-150 bg-red-700 font-bold text-white rounded focus:shadow-outline hover:bg-red-800">Delete</button>
                </form>';
            })
            ->rawColumns(['action'])
            ->make();

        }
        return view('pages.dashboard.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
