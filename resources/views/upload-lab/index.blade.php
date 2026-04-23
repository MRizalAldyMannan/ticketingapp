@extends('layouts.app')

@section('title', 'Overview File Upload - Security Lab')

@section('content')
<div class="mb-4">
    <h2 class="h4">
        <i class="fas fa-file-upload text-primary me-2"></i> File Upload Vulnerability Overview
    </h2>
</div>

<div class="py-4">
    <div class="container">
        <!-- Pengenalan -->
        <div class="card shadow-sm border-0 mb-4 rounded-4 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-8 p-4">
                    <h4 class="fw-bold mb-3 text-dark">Mengapa File Upload Itu Berbahaya?</h4>
                    <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.7;">
                        Fitur unggah berkas (File Upload) adalah salah satu pintu masuk paling favorit bagi peretas (*attacker*). OWASP mengategorikan serangan ini ke dalam kelompok <strong>Security Misconfiguration</strong> atau <strong>Vulnerable and Outdated Components</strong>.
                    </p>
                    <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.7;">
                        Jika Anda membiarkan pengguna mengunggah berkas tanpa penyaringan ketat, mereka bisa saja menaruh berkas skrip jahat (misalnya <code>shell.php</code>). Jika berkas tersebut tersimpan di direktori publik, peretas cukup mengakses URL gambar tersebut untuk mengambil alih seluruh mesin server Anda. Serangan ini dikenal sebagai <strong>Remote Code Execution (RCE)</strong>.
                    </p>
                </div>
                <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-4" style="border-left: 1px solid #e2e8f0;">
                    <i class="fas fa-file-code text-danger opacity-75" style="font-size: 7rem;"></i>
                </div>
            </div>
        </div>

        <!-- Anatomi Serangan -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-danger">
                    <div class="card-header bg-danger text-white fw-bold"><i class="fas fa-biohazard me-2"></i>Dampak Terburuk (The Impact)</div>
                    <div class="card-body">
                        <ul class="text-dark mb-0 form-list">
                            <li class="mb-2"><strong>RCE (Takeover Server):</strong> Penyerang mengeksekusi PHP shell.</li>
                            <li class="mb-2"><strong>Defacement:</strong> Hacker mengubah wajah situs dengan menumpuk file <code>index.php</code> asli aplikasi Anda.</li>
                            <li class="mb-2"><strong>Malware Hosting:</strong> Server Anda dijadikan tempat penyebaran virus atau situs Phising.</li>
                            <li class="mb-0"><strong>DoS via Storage Exhausation:</strong> Mengirimkan file bergiga-gigabyte (zip bomb) untuk mematikan hardisk server.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-header bg-success text-white fw-bold"><i class="fas fa-shield-virus me-2"></i>Anatomi Proteksi</div>
                    <div class="card-body">
                        <ul class="text-dark mb-0 form-list">
                            <li class="mb-2"><strong>MIME & Extension Whitelisting:</strong> Server hanya melayani format PDF, JPG, PNG. Tolak (.php, .exe, .sh, .py).</li>
                            <li class="mb-2"><strong>Rename File:</strong> Jangan gunakan nama file asli (misal: `suratku.pdf`), tapi ganti dengan hash acak (misal: `f8a9...x9.pdf`).</li>
                            <li class="mb-2"><strong>Size Restriction:</strong> Tancapkan limitasi 2MB atau 5MB.</li>
                            <li class="mb-0"><strong>Disable Execution:</strong> Simpan di luar root <code>public</code> (misal di AWS S3 atau <code>storage/</code>) agar skrip tidak bisa dirunning langsung via browser.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Lanjut -->
        <div class="text-end">
            <a href="{{ route('upload-lab.logging') }}" class="btn btn-primary px-4 rounded-pill">Lanjut ke Logging Demo <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</div>
@endsection
