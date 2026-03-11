<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class GuestController extends Controller
{
    public function dashboard()
    {
        $products = Product::latest()->take(8)->get();
        $categories = Category::all();
        return view('guest.dashboard', compact('products', 'categories'));
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        return view('guest.product_detail', compact('product'));
    }

    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products;
        return view('guest.category_products', compact('category', 'products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%'.$query.'%')->get();
        return view('guest.search_results', compact('products', 'query'));
    }
}
