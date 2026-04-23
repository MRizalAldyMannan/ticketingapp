@extends('layouts.app')

@section('title', 'Broken Access Control (BAC) Lab')

@section('content')
<div class="mb-4">
    <h2 class="h4">
        <i class="fas fa-door-open text-primary me-2"></i> Broken Access Control (BAC)
    </h2>
</div>

<div class="py-4">
    <div class="container">
        <!-- Pengenalan -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="fw-bold mb-3">Apa itu Broken Access Control?</h4>
                        <p class="text-secondary" style="font-size: 1.1rem; line-height: 1.8;">
                            <strong>Broken Access Control (BAC)</strong> adalah kerentanan keamanan di mana pembatasan pada apa yang diizinkan untuk dilakukan oleh pengguna yang telah diautentikasi <strong>tidak diterapkan dengan benar</strong>. Pada tahun 2021, OWASP mengkategorikan celah ini sebagai kelemahan aplikasi web <strong>Nomor 1</strong> paling umum dan berbahaya.
                        </p>
                        <p class="text-secondary" style="font-size: 1.1rem; line-height: 1.8;">
                            Hal ini memungkinkan penyerang untuk <i>bypass</i> kontrol wewenang (*authorization*) dan dengan mudah bertindak seolah-olah mereka memiliki hak istimewa Admin.
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-user-secret text-danger opacity-75" style="font-size: 8rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contoh Kegagalan BAC -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-danger">
                    <div class="card-header bg-danger text-white fw-bold">
                        <i class="fas fa-times-circle me-2"></i>Contoh Kegagalan (Vulnerable)
                    </div>
                    <div class="card-body bg-light">
                        <ul class="mb-0 text-dark" style="line-height: 1.8;">
                            <li><strong>Bypass melalui URL:</strong> Memodifikasi URL secara paksa dari <code>/user/dashboard</code> menjadi <code>/admin/dashboard</code> dan server tetap menampilkan halamannya.</li>
                            <li><strong>IDOR (Insecure Direct Object Reference):</strong> Mengganti angka <code>?id=5</code> menjadi <code>?id=6</code> untuk melihat struk gaji karyawan lain.</li>
                            <li><strong>Akses Fungsi Terlarang:</strong> Parameter <code>action=delete_user</code> sengaja tidak di-filter jika dikirim oleh akun Non-Admin.</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-header bg-success text-white fw-bold">
                        <i class="fas fa-check-circle me-2"></i>Cara Pencegahan (Secure)
                    </div>
                    <div class="card-body bg-light">
                        <ul class="mb-0 text-dark" style="line-height: 1.8;">
                            <li><strong>Server-Side Execution:</strong> Mencegah akses menggunakan kode di level <i>Middleware</i> atau <i>Controller</i>. Jangan pernah mengandalkan tombol UI yang disembunyikan.</li>
                            <li><strong>Deny by Default:</strong> Semua halaman tertutup secara bawaan. Hak akses hanya diberikan eksplisit kepada Role tertentu.</li>
                            <li><strong>Record Owner Verification:</strong> Validasi ketat bahwa pengguna <code>User_A</code> benar-benar pemilik sah dari file <code>Dokumen_A</code> sebelum menampilkan atau menghapusnya.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="card bg-dark text-white text-center shadow-lg rounded-4 overflow-hidden mt-4">
            <div class="card-body p-5">
                <h3 class="fw-bold mb-3">Siap Melakukan Demonstrasi BAC?</h3>
                <p class="mb-4 opacity-75">Tugas ini akan meminta Anda membuktikan betapa mudahnya menerobos halaman admin web yang tidak dijaga Middleware akses, dan menemukan halaman 403 (Forbidden).</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('bac-lab.comparison') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">Lihat Comparison <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
