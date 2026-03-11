<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function checkoutSingle($id)
    {
        $cartItem = Cart::with('product')->findOrFail($id);

        // Hitung total harga
        $total = $cartItem->product->price * $cartItem->quantity;

        // Buat transaksi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => $total,
            ],
            'item_details' => [
                [
                    'id' => $cartItem->product->id,
                    'price' => $cartItem->product->price,
                    'quantity' => $cartItem->quantity,
                    'name' => $cartItem->product->name
                ]
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        // BUAT SNAP TOKEN (INI YANG WAJIB ADA)
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('user.checkout', [
            'cartItem' => $cartItem,
            'snapToken' => $snapToken, // WAJIB DIKIRIM KE VIEW
        ]);
    }

    public function checkoutSelected(Request $request)
    {
        $selected = $request->selected_items;

        if (!$selected) {
            return back()->with('error', 'Tidak ada produk yang dipilih!');
        }

        // Ambil data cart berdasarkan ID yang dicentang
        $cartItems = Cart::whereIn('id', $selected)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Data keranjang tidak ditemukan!');
        }

        // Hitung total
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Buat transaksi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $payload = [
            "transaction_details" => [
                "order_id" => "ORDER-" . time(),
                "gross_amount" => $total,
            ],
            "customer_details" => [
                "first_name" => auth()->user()->name,
                "email" => auth()->user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($payload);

        return view('user.checkout', [
            "cartItems" => $cartItems,
            "total" => $total,
            "snapToken" => $snapToken
        ]);
    }



}
