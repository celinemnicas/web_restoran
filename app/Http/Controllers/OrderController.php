<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan halaman pilih Dine-in atau Take Away
    public function index()
    {
        $orders = Order::with('menu')->get(); // Memuat data order beserta relasi menu
        return view('orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'jenis_pesanan' => 'required|in:Dine-in,Takeaway',
            'nomor_meja' => 'nullable|integer',
            'jam_pengambilan' => 'nullable|date_format:"H:i"',
            'status' => 'required|in:Pending,Proses,Siap Saji',
        ]);
    
        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($id);
    
        // Perbarui data pesanan dengan input dari form
        $order->update([
            'jenis_pesanan' => $request->input('jenis_pesanan'),
            'nomor_meja' => $request->input('nomor_meja'),
            'jam_pengambilan' => $request->input('jam_pengambilan'),
            'status' => $request->input('status'),
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    // Method untuk memilih menu
    public function choose($menuId)
    {
        // Ambil semua item di keranjang untuk pengguna yang sedang login
        $cartItems = Cart::where('user_id', auth()->id())->with('menu')->get();
        
        // Hitung total harga
        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->menu->harga * $item->quantity);
        }, 0);

        // Ambil menu yang dipilih
        $menu = Menu::findOrFail($menuId);

        // Kirim data ke view
        return view('orders.choose', compact('cartItems', 'total', 'menu'));
    }

    // Method untuk proses Takeaway
    public function takeAway(Request $request, $menuId)
    {
        // Validasi input
        $request->validate([
            'jam_pengambilan' => 'required',
        ]);

        // Simpan data take-away ke session
        session([
            'menu_id' => $menuId,
            'type' => 'Take Away',
            'jam_pengambilan' => $request->input('jam_pengambilan'),
        ]);

        // Redirect ke halaman checkout
        return redirect()->route('orders.checkout', ['menuId' => $menuId, 'type' => 'Take Away']);
    }

    // Method untuk proses Dine-in
    public function dineIn(Request $request, $menuId)
    {
        // Validasi input
        $request->validate([
            'nomor_meja' => 'required|integer',
        ]);

        // Simpan data dine-in ke session
        session([
            'menu_id' => $menuId,
            'type' => 'Dine-in',
            'nomor_meja' => $request->input('nomor_meja'),
        ]);

        // Redirect ke halaman checkout
        return redirect()->route('orders.checkout', ['menuId' => $menuId, 'type' => 'Dine-in']);
    }

    // Method untuk menampilkan halaman checkout
    public function checkout()
    {
        // Ambil semua item di keranjang untuk pengguna yang sedang login
        $cartItems = Cart::where('user_id', auth()->id())->with('menu')->get();
        
        // Hitung total harga semua item dalam keranjang
        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->menu->harga * $item->quantity);
        }, 0);
        
        // Kirim data ke view
        return view('orders.checkout', compact('cartItems', 'total'));
    }

    // Method untuk finalize pemesanan
    public function finalize(Request $request)
    {
        // Ambil semua item di keranjang untuk pengguna yang sedang login
        $cartItems = Cart::whereIn('id', $request->input('cart_ids'))->with('menu')->get();

        // Pastikan bahwa kita hanya memproses cart_id yang dikirimkan
        foreach ($cartItems as $item) {
            $quantity = $request->input("quantities.{$item->id}", $item->quantity); // Ambil quantity yang disubmit

            // Hitung harga total berdasarkan quantity
            $totalPrice = $item->menu->harga * $quantity;

            // Simpan pesanan untuk setiap item
            $order = new Order([
                'menu_id' => $item->menu_id,
                'cart_id' => $item->id, // Menambahkan cart_id ke pesanan
                'jenis_pesanan' => session('type'),
                'nomor_meja' => session('nomor_meja', null), // Hanya untuk Dine-in
                'jam_pengambilan' => session('jam_pengambilan', null), // Hanya untuk Takeaway
                'status' => 'PENDING', // Status default adalah PENDING
                'informasi_pembeli' => json_encode([
                    'nama' => $request->input('nama'),
                    'nomor_telepon' => $request->input('nomor_telepon'),
                ]),
                'quantity' => $quantity, // Menyimpan jumlah item
                'price' => $totalPrice, // Menyimpan harga total berdasarkan quantity
            ]);

            $order->save();
        }

        // Hapus session setelah selesai
        session()->forget(['type', 'nomor_meja', 'jam_pengambilan']);

        // Hapus item di keranjang setelah finalize
        Cart::where('user_id', auth()->id())->delete();

        // Redirect ke halaman success dengan pesan sukses
        return redirect()->route('order.success', ['orderId' => $order->id]);
    }

    // Method untuk menampilkan halaman success
    public function success($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('daftar-menu')->withErrors(['orderId' => 'Pesanan tidak ditemukan.']);
        }

        return view('orders.success', ['order' => $order]);
    }
    
    public function submit(Request $request, $menuId)
    {
        // Validasi input berdasarkan jenis pesanan
        if ($request->input('type') == 'Dine-in') {
            $request->validate(['nomor_meja' => 'required|integer']);
            session(['nomor_meja' => $request->input('nomor_meja')]);
        } elseif ($request->input('type') == 'Takeaway') {
            $request->validate(['jam_pengambilan' => 'required|date_format:H:i']);
            session(['jam_pengambilan' => $request->input('jam_pengambilan')]);
        }

        session(['type' => $request->input('type')]);

        // Redirect ke halaman checkout
        return redirect()->route('orders.checkout', [
            'menuId' => $menuId,
            'type' => $request->input('type'),
        ]);
    }
}
