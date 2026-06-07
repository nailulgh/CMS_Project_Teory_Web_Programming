<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Penulis;

class PenulisController extends Controller
{
    public function index()
    {
        $penulis = Penulis::orderBy('nama_depan', 'asc')->get();
        return view('penulis.index', compact('penulis'));
    }

    public function create()
    {
        return view('penulis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_depan'    => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'user_name'     => 'required|string|max:50|unique:penulis,user_name',
            'password'      => 'required|string|min:8',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaFoto = 'default.png';
        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $namaFoto = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('foto', $namaFoto, 'public');
        }

        Penulis::create([
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'user_name'     => $request->user_name,
            'password'      => bcrypt($request->password),
            'foto'          => $namaFoto,
        ]);

        return redirect()->route('penulis.index')
            ->with('sukses', 'Penulis berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $penulis = Penulis::findOrFail($id);
        return view('penulis.edit', compact('penulis'));
    }

    public function update(Request $request, string $id)
    {
        $penulis = Penulis::findOrFail($id);

        $request->validate([
            'nama_depan'    => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'user_name'     => 'required|string|max:50|unique:penulis,user_name,' . $id,
            'password'      => 'nullable|string|min:8',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'user_name'     => $request->user_name,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($penulis->foto !== 'default.png') {
                Storage::disk('public')->delete('foto/' . $penulis->foto);
            }
            $file         = $request->file('foto');
            $namaFoto     = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('foto', $namaFoto, 'public');
            $data['foto'] = $namaFoto;
        }

        $penulis->update($data);

        return redirect()->route('penulis.index')
            ->with('sukses', 'Data penulis berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $penulis = Penulis::findOrFail($id);

        try {
            $foto = $penulis->foto;
            $penulis->delete();

            if ($foto !== 'default.png') {
                Storage::disk('public')->delete('foto/' . $foto);
            }

            return redirect()->route('penulis.index')
                ->with('sukses', 'Data penulis berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('penulis.index')
                ->with('gagal', 'Penulis tidak dapat dihapus karena masih memiliki artikel.');
        }
    }
}
