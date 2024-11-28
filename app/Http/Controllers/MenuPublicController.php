<?php
namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuPublicController extends Controller
{
    public function index(Request $request)
{
    // Ambil parameter kategori dari URL
    $kategoriId = $request->get('kategori_id');

    if ($kategoriId) {
        // Jika kategori dipilih, filter menu berdasarkan kategori
        $menus = Menu::where('kategori_id', $kategoriId)->with('kategori')->get();
    } else {
        // Jika tidak ada kategori dipilih, tampilkan semua menu
        $menus = Menu::with('kategori')->get();
    }

    // Ambil semua kategori untuk sidebar
    $kategoris = Kategori::all();

    return view('menu.index', compact('menus', 'kategoris', 'kategoriId'));
}

}

