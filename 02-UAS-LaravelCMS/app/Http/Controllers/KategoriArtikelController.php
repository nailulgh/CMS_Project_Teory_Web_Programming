<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriArtikel;

class KategoriArtikelController extends Controller
{
    public function index()
    {
        $kategori = KategoriArtikel::orderBy('nama_kategori', 'asc')->get();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_artikel,nama_kategori',
            'keterangan'    => 'nullable|string',
        ]);

        KategoriArtikel::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')
            ->with('sukses', 'Kategori berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $kategori = KategoriArtikel::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $kategori = KategoriArtikel::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_artikel,nama_kategori,' . $id,
            'keterangan'    => 'nullable|string',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')
            ->with('sukses', 'Kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriArtikel::findOrFail($id);

        try {
            $kategori->delete();
            return redirect()->route('kategori.index')
                ->with('sukses', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kategori.index')
                ->with('gagal', 'Kategori tidak dapat dihapus karena masih memiliki artikel.');
        }
    }
}
