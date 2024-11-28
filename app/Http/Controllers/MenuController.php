<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('menus.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images/menus', 'public'); // Simpan gambar di storage
        }

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function index()
    {
        $menus = Menu::with('kategori')->get(); // Menampilkan semua menu beserta kategori
        return view('menus.index', compact('menus'));
    }
    

    // Menampilkan form edit menu
    public function edit(Menu $menu)
    {
        $kategoris = Kategori::all();
        return view('menus.edit', compact('menu', 'kategoris'));
    }

    // Mengupdate data menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar) {
                Storage::delete('public/' . $menu->gambar);
            }

            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('images/menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }
    public function destroy($id)
    {
        // Mencari menu berdasarkan ID
        $menu = Menu::findOrFail($id);

        // Menghapus menu
        $menu->delete();

        // Mengarahkan kembali ke daftar menu dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}
