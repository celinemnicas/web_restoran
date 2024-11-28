<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
{
    $kategoris = Kategori::all();
    return view('kategoris.index', compact('kategoris'));
}

public function create()
{
    return view('kategoris.create');
}

public function store(Request $request)
{
    $request->validate(['nama_kategori' => 'required']);
    Kategori::create($request->all());
    return redirect()->route('kategoris.index');
}

public function edit(Kategori $kategori)
{
    return view('kategoris.edit', compact('kategori'));
}

public function update(Request $request, Kategori $kategori)
{
    $request->validate(['nama_kategori' => 'required']);
    $kategori->update($request->all());
    return redirect()->route('kategoris.index');
}

public function destroy(Kategori $kategori)
{
    $kategori->delete();
    return redirect()->route('kategoris.index');
}

}
