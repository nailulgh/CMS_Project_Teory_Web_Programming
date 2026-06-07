@extends('layouts.public')

@section('title', $artikel->judul . ' - Blog Kami')

@section('content')
<main class="container mx-auto px-4 max-w-6xl py-8 flex flex-col lg:flex-row gap-8">
    <!-- Left Column: Article Detail -->
    <div class="lg:w-2/3">
        <!-- Breadcrumbs -->
        <nav aria-label="Breadcrumb" class="text-sm text-gray-500 mb-6">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a class="text-btn-green hover:text-btn-green-hover font-medium" href="{{ route('public.index') }}">Beranda</a>
                    <span class="mx-2">/</span>
                </li>
                @if($artikel->kategori)
                <li class="flex items-center">
                    <a class="text-btn-green hover:text-btn-green-hover font-medium" href="{{ route('public.kategori', $artikel->kategori->id) }}">{{ $artikel->kategori->nama_kategori }}</a>
                    <span class="mx-2">/</span>
                </li>
                @endif
                <li class="flex items-center text-gray-400">
                    {{ Str::limit($artikel->judul, 30) }}
                </li>
            </ol>
        </nav>

        <!-- Article Card -->
        <article class="bg-white rounded-lg shadow-sm overflow-hidden p-8 border border-gray-100">
            <!-- Featured Image -->
            @if($artikel->gambar)
                <img alt="{{ $artikel->judul }}" class="w-full h-auto rounded-lg mb-6 object-cover aspect-video" src="{{ asset('storage/gambar/' . $artikel->gambar) }}"/>
            @else
                <img alt="{{ $artikel->judul }}" class="w-full h-auto rounded-lg mb-6 object-cover aspect-video" src="https://via.placeholder.com/800x400?text=No+Image"/>
            @endif

            <!-- Category Badge -->
            <span class="inline-block bg-tag-bg text-tag-text text-xs font-semibold px-3 py-1 rounded-full mb-4">
                {{ $artikel->kategori->nama_kategori ?? 'Tanpa Kategori' }}
            </span>

            <!-- Article Title -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6 leading-tight">
                {{ $artikel->judul }}
            </h1>

            <!-- Author Info -->
            <div class="flex items-center mb-8">
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold mr-4">
                    {{ substr($artikel->penulis->nama_depan ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ $artikel->penulis ? trim($artikel->penulis->nama_depan . ' ' . $artikel->penulis->nama_belakang) : 'Anonim' }}</p>
                    <p class="text-xs text-gray-500">{{ $artikel->hari_tanggal }}</p>
                </div>
            </div>

            <!-- Article Content -->
            <div class="prose max-w-none text-gray-800 leading-relaxed space-y-6">
                {!! $artikel->isi !!}
            </div>
        </article>
    </div>

    <!-- Right Column: Sidebar -->
    <aside class="lg:w-1/3">
        <!-- Related Articles Widget -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 sticky top-6">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Artikel Terkait</h2>
            <div class="space-y-6">
                @forelse($artikelTerkait as $terkait)
                <a class="flex group" href="{{ route('public.show', $terkait->id) }}">
                    @if($terkait->gambar)
                        <img alt="Thumbnail" class="w-20 h-16 object-cover rounded-md mr-4 flex-shrink-0" src="{{ asset('storage/gambar/' . $terkait->gambar) }}"/>
                    @else
                        <img alt="Thumbnail" class="w-20 h-16 object-cover rounded-md mr-4 flex-shrink-0" src="https://via.placeholder.com/150?text=No+Image"/>
                    @endif
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800 group-hover:text-brand-blue line-clamp-2 leading-tight">{{ $terkait->judul }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ explode(' | ', $terkait->hari_tanggal)[0] ?? $terkait->hari_tanggal }}</p>
                    </div>
                </a>
                @empty
                    <p class="text-sm text-gray-500">Tidak ada artikel terkait.</p>
                @endforelse
            </div>
        </div>
    </aside>
</main>
@endsection
