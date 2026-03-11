<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // pastikan model Product ada

class AdminController extends Controller
{
    public function index()
    {
        // Hitung total produk
        $totalProducts = Product::count();

        // Karena belum ada tabel orders
        $totalOrders = 0;
        $totalRevenue = 0;

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalRevenue'));
    }
}
