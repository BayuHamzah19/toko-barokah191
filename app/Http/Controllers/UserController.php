<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // ← WAJIB! Tambahkan ini
use App\Models\Category;


class UserController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Ambil data produk
        $categories = Category::all(); // ✅ ambil semua kategori
        return view('user.dashboard', compact('products', 'categories'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    

}
