<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\Transaction_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Exception;

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

    public function addToCart(Request $request, $id) {
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ]);

        return redirect('cart');
    }

    public function deleteCart(Request $request, $id) {
        Cart::findOrFail($id)->delete();

        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $carts = Cart::with('product.gallery')->where('user_id', Auth::user()->id)->get();
        return view('pages.frontend.cart', compact('carts'));
    }

    public function checkout(CheckoutRequest $request) {
        $data = $request->all();

        $carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();

        $data['user_id'] = Auth::user()->id;
        $data['total'] = $carts->sum('product.price');

        $transaction = Transaction::create($data);

        foreach ($carts as $cart){
            $items[''] = Transaction_item::create([
                'transaction_id' => $transaction->id,
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        // Midtrans Config
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            'transaction_details' => [
                'order_id' => 'LUX-' . $transaction->id,
                'gross_amount' => (int) $transaction->total
            ],
            'customer_details' => [
                'first_name' => $transaction->name,
                'email' => $transaction->email
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        // Proccess
        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function success(Request $request)
    {
        return view('pages.frontend.success');
    }
}
