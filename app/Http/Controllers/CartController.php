<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('user.keranjang', compact('cart'));
    }

    public function store($productId)
    {
        $product = Product::findOrFail($productId);

        Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $productId
            ],
            [
                'quantity' => \DB::raw('quantity + 1')
            ]
        );

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        Cart::where('id', $id)->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Jumlah diperbarui.');
    }

    public function destroy($id)
    {
        Cart::where('id', $id)->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
