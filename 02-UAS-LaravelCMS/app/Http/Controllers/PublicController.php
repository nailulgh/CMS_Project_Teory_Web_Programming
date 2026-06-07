<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman utama dengan 5 artikel terbaru dan widget kategori.
     */
    public function index()
    {
        // Mengambil 5 artikel terbaru dengan relasi kategori dan penulis
        $artikels = Artikel::with(['kategori', 'penulis'])
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Mengambil daftar kategori beserta jumlah artikelnya
        $kategoris = KategoriArtikel::withCount('artikel')->get();

        $totalArtikel = Artikel::count();

        return view('public.index', compact('artikels', 'kategoris', 'totalArtikel'));
    }

    /**
     * Menampilkan halaman artikel yang difilter berdasarkan kategori tertentu.
     */
    public function kategori($id)
    {
        $kategoriAktif = KategoriArtikel::findOrFail($id);

        $artikels = Artikel::with(['kategori', 'penulis'])
            ->where('id_kategori', $id)
            ->orderBy('id', 'desc')
            ->get();

        $kategoris = KategoriArtikel::withCount('artikel')->get();
        $totalArtikel = Artikel::count();

        return view('public.index', compact('artikels', 'kategoris', 'kategoriAktif', 'totalArtikel'));
    }

    /**
     * Menampilkan halaman detail artikel beserta 5 artikel terkait.
     */
    public function show($id)
    {
        $artikel = Artikel::with(['kategori', 'penulis'])->findOrFail($id);

        // Mengambil 5 artikel terkait dalam kategori yang sama, kecuali artikel yang sedang dilihat
        $artikelTerkait = Artikel::where('id_kategori', $artikel->id_kategori)
            ->where('id', '!=', $artikel->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('public.show', compact('artikel', 'artikelTerkait'));
    }
}
