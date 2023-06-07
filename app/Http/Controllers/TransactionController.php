<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaction_item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if(request()->ajax()){
        $query = Transaction::query();
        return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                <a href="' . route('dashboard.transaction.show', $item->id) . '" class="bg-green-400 hover:bg-green-700 text-white font-bold -my-3 py-2 px-4 rounded shadow-lg">Show</a>
                <a href="' . route('dashboard.transaction.edit', $item->id) . '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold -my-3 py-2 px-4 rounded shadow-lg">Edit</a>
                ';
            })
            ->editColumn('total', function($item){
                return number_format($item->total);
            })
            ->rawColumns(['action', 'total'])
            ->make();
    }
    return view('pages.dashboard.transaction.index');
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
    public function show(Transaction $transaction)
    {
        if(request()->ajax()){
        $query = Transaction_item::query()->with(['product'])->where('transaction_id', $transaction->id);
        return DataTables::of($query)
            ->editColumn('product.price', function($item){
                return number_format($item->product->price);
            })
            // ->rawColumns(['product.price'])
            ->make();
    }
    return view('pages.dashboard.transaction.show', compact('transaction'));
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
