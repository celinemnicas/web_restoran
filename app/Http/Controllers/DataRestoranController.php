<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataRestoran;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Menu;
use App\Models\User;
use App\Models\Kategori;

class DataRestoranController extends Controller
{
    public function index()
    {
        // Ambil data utama
        $dataRestoran = DataRestoran::with(['user', 'menu', 'order'])->get();

        // Ambil semua data terkait
        $menus = Menu::all();        
        $orders = Order::all();      
        $carts = Cart::all();        
        $kategoris = Kategori::all(); 

        // Hitung total data
        $totalOrders = $orders->count();
        $totalCarts = $carts->count();
        $totalMenus = $menus->count();

        // Passing data ke view
        return view('datarestorans.index', compact(
            'dataRestoran', 'menus', 'orders', 'carts', 'kategoris', 'totalOrders', 'totalCarts', 'totalMenus'
        ));
    }
}
