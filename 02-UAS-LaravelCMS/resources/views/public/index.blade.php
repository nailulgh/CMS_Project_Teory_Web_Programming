@extends('layouts.public')

@section('title', 'Blog Kami - Halaman Utama Pengunjung')

@section('content')
<main class="container mx-auto px-4 py-8 max-w-6xl flex flex-col md:flex-row gap-8">
    <!-- Articles List -->
    <section class="flex-1 space-y-8">
        @if(isset($kategoriAktif))
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Kategori: {{ $kategoriAktif->nama_kategori }}</h2>
                @if($kategoriAktif->keterangan)
                    <p class="text-gray-500 text-sm mt-1">{{ $kategoriAktif->keterangan }}</p>
                @endif
            </div>
        @endif

        @forelse($artikels as $artikel)
            <article class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col">
                @if($artikel->gambar)
                    <img alt="{{ $artikel->judul }}" class="w-full h-56 object-cover" src="{{ asset('storage/gambar/' . $artikel->gambar) }}"/>
                @else
                    <img alt="{{ $artikel->judul }}" class="w-full h-56 object-cover" src="https://via.placeholder.com/800x400?text=No+Image"/>
                @endif
                <div class="p-6">
                    <span class="inline-block px-3 py-1 bg-tag-bg text-tag-text text-xs font-semibold rounded-full mb-3">
                        {{ $artikel->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                    </span>
                    <h2 class="text-xl font-bold mb-3">{{ $artikel->judul }}</h2>
                    <div class="flex items-center text-sm text-gray-500 mb-4 space-x-2">
                        <div class="w-6 h-6 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-xs">
                            {{ substr($artikel->penulis->nama_depan ?? 'A', 0, 1) }}
                        </div>
                        <span>{{ $artikel->penulis ? trim($artikel->penulis->nama_depan . ' ' . $artikel->penulis->nama_belakang) : 'Anonim' }}</span>
                        <span>&bull;</span>
                        <span>{{ $artikel->hari_tanggal }}</span>
                    </div>
                    <p class="text-text-gray text-sm leading-relaxed mb-6">
                        {{ Str::limit(strip_tags($artikel->isi), 150) }}
                    </p>
                    <a class="inline-block px-4 py-2 bg-btn-green hover:bg-btn-green-hover text-white text-sm font-medium rounded-md transition-colors" href="{{ route('public.show', $artikel->id) }}">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </article>
        @empty
            <div class="bg-white rounded-xl shadow-sm p-12 flex flex-col items-center justify-center min-h-[300px] text-center border border-gray-100">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500">Saat ini belum ada artikel yang dipublikasikan di kategori ini. Silakan kembali lagi nanti.</p>
            </div>
        @endforelse
    </section>

    <!-- Sidebar -->
    <aside class="w-full md:w-80 flex-shrink-0">
        <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
            <h3 class="text-lg font-bold mb-4">Kategori Artikel</h3>
            <ul class="space-y-2">
                <!-- Semua Artikel -->
                <li>
                    <a class="flex items-center justify-between p-2 {{ !isset($kategoriAktif) ? 'bg-sidebar-active-bg text-sidebar-active-text font-medium' : 'hover:bg-gray-50 text-gray-700' }} rounded-md transition-colors text-sm" href="{{ route('public.index') }}">
                        <span>Semua Artikel</span>
                        <span class="{{ !isset($kategoriAktif) ? 'bg-badge-active-bg text-badge-active-text' : 'bg-badge-bg text-badge-text' }} text-xs py-0.5 px-2 rounded-full font-medium">{{ $totalArtikel ?? 0 }}</span>
                    </a>
                </li>
                
                <!-- List Kategori -->
                @foreach($kategoris as $kat)
                <li>
                    @php
                        $isActive = isset($kategoriAktif) && $kategoriAktif->id == $kat->id;
                    @endphp
                    <a class="flex items-center justify-between p-2 {{ $isActive ? 'bg-sidebar-active-bg text-sidebar-active-text font-medium' : 'hover:bg-gray-50 text-gray-700' }} rounded-md transition-colors text-sm" href="{{ route('public.kategori', $kat->id) }}">
                        <span>{{ $kat->nama_kategori }}</span>
                        <span class="{{ $isActive ? 'bg-badge-active-bg text-badge-active-text' : 'bg-badge-bg text-badge-text' }} text-xs py-0.5 px-2 rounded-full font-medium">{{ $kat->artikel_count }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>
</main>
@endsection
