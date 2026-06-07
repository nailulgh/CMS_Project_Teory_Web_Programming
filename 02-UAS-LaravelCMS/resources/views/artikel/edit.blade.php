@extends('layouts.app')
@section('title', 'Edit Artikel')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="fw-semibold mb-0" style="color: #333333;">Edit Artikel</h6>
    <a href="{{ route('artikel.index') }}" class="btn btn-sm"
        style="background-color: #f0f0f0; color: #555555;">
        Kembali
    </a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judul" class="form-label fw-semibold" style="font-size: 13px;">
                    Judul <span class="text-danger">*</span>
                </label>
                <input type="text"
                    class="form-control @error('judul') is-invalid @enderror"
                    id="judul"
                    name="judul"
                    value="{{ old('judul', $artikel->judul) }}"
                    placeholder="Masukkan judul artikel">
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id_kategori" class="form-label fw-semibold" style="font-size: 13px;">
                    Kategori <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('id_kategori') is-invalid @enderror"
                    id="id_kategori"
                    name="id_kategori">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ old('id_kategori', $artikel->id_kategori) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label fw-semibold" style="font-size: 13px;">
                    Isi Artikel <span class="text-danger">*</span>
                </label>
                <textarea class="form-control @error('isi') is-invalid @enderror"
                    id="isi"
                    name="isi"
                    rows="6"
                    placeholder="Masukkan isi artikel">{{ old('isi', $artikel->isi) }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="gambar" class="form-label fw-semibold" style="font-size: 13px;">
                    Gambar
                </label>
                <div class="mb-2">
                    <img src="{{ asset('storage/gambar/' . $artikel->gambar) }}"
                        alt="Gambar Artikel"
                        style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #e9ecef;">
                </div>
                <input type="file"
                    class="form-control @error('gambar') is-invalid @enderror"
                    id="gambar"
                    name="gambar"
                    accept="image/jpg,image/jpeg,image/png">
                <div class="form-text" style="font-size: 12px;">
                    Format yang diizinkan: JPG, JPEG, PNG. Ukuran maksimal 2 MB.
                    Kosongkan jika tidak ingin mengubah gambar.
                </div>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('artikel.index') }}" class="btn btn-sm"
                    style="background-color: #f0f0f0; color: #555555;">
                    Batal
                </a>
                <button type="submit" class="btn btn-sm btn-success">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
