@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex justify-content-center align-items-center"
    style="min-height: calc(100vh - 160px);">
    <div class="card border-0 shadow-sm" style="max-width: 480px; width: 100%; border-radius: 12px;">
        <div class="card-body p-4 p-md-5 text-center">
            <div class="mb-4">
                <div style="width: 64px; height: 64px; border-radius: 50%;
                    background-color: #e8f5e9; display: flex;
                    align-items: center; justify-content: center;
                    margin: 0 auto 16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                        fill="none" viewBox="0 0 24 24" stroke="#2e7d32" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2
                            2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0
                            011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h5 class="fw-semibold mb-1">
                    Selamat datang,
                    <span style="color: #2e7d32;">{{ $nama_lengkap }}</span>
                </h5>
                <p class="text-muted small mb-0">
                    Silakan pilih menu di sebelah kiri untuk mulai mengelola konten blog.
                </p>
            </div>
            <hr class="my-3">
            <div class="row g-3 text-start">
                <div class="col-6">
                    <div class="p-3 rounded" style="background-color: #f8f9fa;">
                        <div class="text-uppercase fw-semibold mb-1"
                            style="font-size: 10px; color: #adb5bd; letter-spacing: 0.05em;">
                            Login sebagai
                        </div>
                        <div style="font-size: 12px; font-weight: 500; color: #212529;">
                            {{ $nama_lengkap }}
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded" style="background-color: #f8f9fa;">
                        <div class="text-uppercase fw-semibold mb-1"
                            style="font-size: 10px; color: #adb5bd; letter-spacing: 0.05em;">
                            Waktu login
                        </div>
                        <div style="font-size: 12px; font-weight: 500; color: #212529;">
                            {{ $waktu_login }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
