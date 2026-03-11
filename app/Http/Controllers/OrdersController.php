<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Midtrans\Config;
use Midtrans\Snap;

class OrdersController extends Controller
{

    public function __construct(Request $request){

        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        
    }

    // Tampilkan semua pesanan user
    public function index()
    {
        $orders = auth()->user()->orders()->with('product')->get();
        return view('user.orders', compact('orders'));
    }

    // Buat order baru
    public function create(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $quantity = $request->input('quantity', 1);

        $order = Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.checkout', $order->id);
    }

    // Halaman checkout
    public function checkout(Order $order)
    {
        // Pastikan order milik user
        if ($order->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke order ini.');
        }

        // Pastikan total_price valid
        if (is_null($order->total_price) || $order->total_price <= 0) {
            abort(400, 'Total pembayaran harus lebih dari 0. Pastikan order memiliki total_price.');
        }

        $grossAmount = (int) $order->total_price;

        // Transaction details
        $transaction_details = [
            'order_id' => 'ORDER-' . $order->id . '-' . time(),
            'gross_amount' => $grossAmount,
        ];

        // Customer details
        $customer_details = [
            'first_name' => auth()->user()->name ?? 'Customer',
            'email' => auth()->user()->email ?? 'test@gmail.com',
            'phone' => auth()->user()->phone ?: "085749888777",
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details           
        ];

        try {
        // Generate Snap token
            $snapToken = Snap::getSnapToken($transaction);

            //dd($snapToken);
        } catch(\Exception $e){

            return response()->json([
                'error' => true,
                'msg' => $e->getMessage(),
            ]);
        }



        return view('user.checkout', compact('order', 'snapToken'));
    }

    // Callback / webhook (opsional)
    public function callback(Request $request)
    {
        // Bisa diisi untuk update status order otomatis
        // sesuai dengan notifikasi Midtrans
    }
}
