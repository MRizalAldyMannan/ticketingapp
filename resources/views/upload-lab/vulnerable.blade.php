@extends('layouts.app')

@section('title', 'Vulnerable Upload - Security Lab')

@section('content')
<div class="mb-4">
    <h2 class="h4 text-danger fw-bold">
        <i class="fas fa-spider me-2"></i> Lab: Vulnerable File Upload
    </h2>
</div>

<div class="py-4">
    <div class="container">
        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-warning shadow-sm d-flex align-items-center mb-4 border-warning border-2" role="alert">
                <i class="fas fa-check-circle fs-3 me-3 text-warning"></i>
                <div>
                    <strong>Upload Berjalan (Bocor):</strong> {{ session('success') }}<br>
                    <small>Coba upload file berbahaya, misalnya sebuah gambar siluman berisi <code>&lt;?php passthru('ls'); ?&gt;</code> dengan ekstensi <strong>.php</strong>. Pasti tetap masuk!</small>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-danger">
                    <div class="card-header bg-danger text-white fw-bold">
                        <i class="fas fa-upload me-2"></i>Form Pengajuan Cuti (Rentan)
                    </div>
                    <div class="card-body bg-light p-4">
                        <p class="text-muted small mb-4">Unggah dokumen surat izin Anda (Seharusnya dibatasi PDF). Karena kodingannya rentan, coba selelahnya dengan file seperti `.exe` atau script yang bisa Anda pikirkan.</p>
                        
                        <form action="{{ route('upload-lab.vulnerable-submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="document" class="form-label fw-bold">Pilih Berkas</label>
                                <input class="form-control" type="file" id="document" name="document" required>
                                <div class="form-text text-danger mt-2"><i class="fas fa-exclamation-triangle me-1"></i>Server: "Silakan kirim file apapun. Saya tidak peduli, saya terima dan simpan semuanya."</div>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 fw-bold shadow-sm">Kirim & Unggah <i class="fas fa-paper-plane ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 bg-dark text-white rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4 text-warning"><i class="fas fa-bug border border-warning rounded-circle p-2 me-2"></i>Bedah Celah Berbahaya</h4>
                        <p class="text-light-50">Di file <code>UploadLabController.php</code> sistem ini tertulis:</p>
                        
                        <div class="bg-black p-3 rounded-3 mb-4 font-monospace text-success small shadow-inner">
                            $file = $request->file('document');<br>
                            <span class="text-secondary">// Hacker bebas kirim .php shell !</span><br>
                            $filename = $file->getClientOriginalName(); <br><br>
                            
                            <span class="text-secondary">// Menyimpan mentah-mentah ke direktori <code>public</code> yg bisa diakses browser.</span><br>
                            <span class="text-danger">Storage::disk('public')->put($filename, file_get_contents($file));</span>
                        </div>
                        
                        <ul class="text-light-50 small">
                            <li>Tidak ada validasi tipe MIME (Mime Type checking).</li>
                            <li>Mengandalkan aslinya (*Client Original Name*) yang rentan manipulasi (seperti: <code>../../../etc/passwd</code>).</li>
                            <li>Setelah ditaruh, file bisa dieksekusi langsung oleh Hacker dengan mengunjungi URL tempat file itu berada di web server.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-5 text-center">
            <a href="{{ route('upload-lab.secure') }}" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow hover-lift">Pelajari Cara Menutup Celah Ini (Secure) <i class="fas fa-shield-alt ms-2"></i></a>
        </div>

    </div>
</div>

@push('styles')
<style>
    .hover-lift:hover { transform: translateY(-3px); transition: 0.2s ease-out; }
    .shadow-inner { box-shadow: inset 0px 4px 10px rgba(0,0,0,0.8); }
</style>
@endpush
@endsection
