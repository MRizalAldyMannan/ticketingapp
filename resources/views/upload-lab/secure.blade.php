@extends('layouts.app')

@section('title', 'Secure Upload - Security Lab')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-success fw-bold mb-0">
            <i class="fas fa-shield-check me-2"></i> Lab: Secure File Upload
        </h2>
    </div>
</div>

<div class="py-4">
    <div class="container">
        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success shadow-sm border-0 d-flex align-items-center mb-4 rounded-3" role="alert">
                <i class="fas fa-check-circle fs-3 me-3"></i>
                <div>
                    <strong>Sistem Aman Bekerja:</strong> {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger shadow-sm border-0 d-flex mb-4 rounded-3" role="alert">
                <i class="fas fa-ban fs-3 me-3 mt-1"></i>
                <div>
                    <strong>Upload DITOLAK Secara Server-Side:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-header bg-success text-white fw-bold">
                        <i class="fas fa-file-shield me-2"></i>Form Pengajuan Cuti (Standard Industri)
                    </div>
                    <div class="card-body bg-light p-4">
                        <p class="text-muted small mb-4">Sistem ini memaksakan bahwa file hanya boleh <strong>.PDF, .JPG, atau .PNG</strong> dengan batas ukuran ketat maksimal 2 Megabytes. Cobalah *bypass* dengan mengunggah skrip atau txt.</p>
                        
                        <form action="{{ route('upload-lab.secure-submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="document" class="form-label fw-bold">Pilih Dokumen PDF/JPG/PNG Max 2MB <span class="text-danger">*</span></label>
                                <!-- Kita hapus "accept" mimes di HTML agar Anda terpaksa mengandalkan server-side. -->
                                <input class="form-control form-control-lg border-success" type="file" id="document" name="document" required>
                                <div class="form-text text-success mt-2"><i class="fas fa-lock me-1"></i>Server: File Anda divalidasi MIME dan diganti namanya menjadi hash unik.</div>
                            </div>
                            <button type="submit" class="btn btn-success w-100 btn-lg fw-bold shadow-sm">Kirim & Validasi Aman <i class="fas fa-lock ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 bg-dark text-white rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4 text-success"><i class="fas fa-shield-virus border border-success rounded-circle p-2 me-2"></i>Lapisan Pertahanan Server</h4>
                        
                        <div class="bg-black p-3 rounded-3 mb-4 font-monospace text-warning small shadow-inner">
                            <span class="text-secondary">// 1. Validasi Ekstensi dan Size Maksimum</span><br>
                            $request->validate(['document' => <br>
                            <span class="text-success">'mimes:pdf,jpg,png|max:2048'</span>]); <br><br>
                            
                            <span class="text-secondary">// 2. Rename File dengan karakter acak 16 bit</span><br>
                            $securedName = time().<span class="text-info">bin2hex</span>(random_bytes(8)).<span class="text-danger">'.'</span>.$ext; <br><br>

                            <span class="text-secondary">// 3. Catat di Security Logs</span><br>
                            $this->addLog(<span class="text-success">'SECURITY'</span>, <span class="text-info">'Secure upload by IP...'</span>);
                        </div>
                        
                        <ul class="text-light-50 small">
                            <li>Memaksa MIME Type <code>pdf,jpg,png</code> melalui Validator di Framework, jauh lebih aman dari deteksi Regex.</li>
                            <li>Kapasitas diblokir keras, mencegah serangan DoS (Memory Exhaustion).</li>
                            <li>Tindakan Upload ini dicatat ke dalam Logging Server. Fitur yang vital! Coba buka kembali menu Logging untuk melihat jejaknya.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <a href="{{ route('upload-lab.logging') }}" class="btn btn-outline-dark px-4 py-2 rounded-pill fw-bold shadow-sm"><i class="fas fa-search me-2"></i>Periksa Riwayat Pencatatan (Logs)</a>
        </div>

    </div>
</div>

@push('styles')
<style>
    .shadow-inner { box-shadow: inset 0px 4px 10px rgba(0,0,0,0.8); }
</style>
@endpush
@endsection
