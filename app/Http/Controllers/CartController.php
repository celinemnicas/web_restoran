<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;

class CartController extends Controller
{
    // Tampilkan keranjang belanja
    public function index()
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang login
        $cartItems = Cart::with('menu.kategori')->where('user_id', $userId)->get();
        $total = $cartItems->sum(fn($item) => $item->menu->harga * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Tambahkan item ke keranjang
    public function addToCart($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $userId = auth()->id(); // Mendapatkan ID pengguna yang login
        
        // Cek apakah item sudah ada di keranjang pengguna
        $cartItem = Cart::where('user_id', $userId)
                        ->where('menu_id', $menuId)
                        ->first();
    
        if ($cartItem) {
            // Jika sudah ada, update jumlahnya
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika belum ada, tambahkan item baru
            Cart::create([
                'user_id' => $userId,
                'menu_id' => $menuId,
                'quantity' => 1,
            ]);
        }
    
        return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }
    
    // Perbarui jumlah item di keranjang
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id); // Cari item berdasarkan ID
        $cartItem->quantity = $request->quantity; // Perbarui jumlah
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Jumlah menu berhasil diperbarui!');
    }

    // Hapus item dari keranjang
    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id); // Cari item berdasarkan ID
        $cartItem->delete(); // Hapus item

        return redirect()->route('cart.index')->with('success', 'Menu berhasil dihapus dari keranjang!');
    }
}
