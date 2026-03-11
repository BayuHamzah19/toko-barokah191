<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;


class BelanjaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian, kategori, dan sorting
        $search   = $request->search;
        $category = $request->category;
        $sort     = $request->sort;

        // Query dasar
        $query = Product::query();

        // Pencarian
        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        // Filter kategori
        if ($category) {
            $query->where('category_id', $category);
        }

        // Sorting
        if ($sort == 'termurah') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'termahal') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'terbaru') {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->get();

        // Ambil semua kategori untuk dropdown
        $categories = Category::all();

        return view('user.belanja', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('user.belanja-detail', compact('product'));
    }

    public function beli(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        Order::create([
            'user_id'     => auth()->id(),
            'product_id'  => $product->id,
            'quantity'    => $request->quantity,
            'total_price' => $product->price * $request->quantity,
            'status'      => 'pending',
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat, menunggu persetujuan admin.');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->product_id;

        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $productId
            ],
            [
                'quantity' => \DB::raw('quantity + 1')
            ]
        );

        $cartCount = Cart::where('user_id', auth()->id())->count();

        return response()->json([
            'success' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $cartCount
        ]);
    }


}
