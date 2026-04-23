@extends('layouts.app')

@section('title', 'Validasi Input - Security Lab')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Validasi Input & Sanitasi</h2>
        <p class="lead">Halaman ini mendemonstrasikan bagaimana aplikasi menangkap, memvalidasi form, dan membersihkan input tag bahaya (sanitasi) demi keamanan.</p>
        <div class="alert alert-info">
            <strong>Mengapa Validasi Penting?</strong> Validasi input adalah garis pertahanan pertama (First line of defense) untuk memblokir data yang keliru sebelum masuk ke dalam sistem. Sedangkan <strong>Sanitasi</strong> (seperti `strip_tags`) bertugas mencukur skrip / HTML berbahaya (mencegah XSS).
        </div>
    </div>

    <div class="col-md-8 mx-auto mb-4">
        <div class="card border-primary shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Simulasi Input Komentar</h5>
            </div>
            <div class="card-body p-4 bg-white">
                <div class="alert alert-secondary small">
                    <i class="fas fa-lightbulb text-warning me-1"></i><strong>Tips Lab:</strong><br/>
                    1. Coba klik "Kirim" saat isian masih <strong>kosong</strong> untuk melihat sistem validasi beraksi (pesan bahasa Indonesia).<br/>
                    2. Coba kirim input berisi tag HTML seperti <code>&lt;b&gt;teks&lt;/b&gt;</code> atau <code>&lt;script&gt;</code> untuk melihat sistem sanitasi bekerja memotong string tersebut.
                </div>
                
                <form action="{{ route('security.validation.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="author_name" class="form-label fw-bold">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('author_name') is-invalid @enderror" id="author_name" name="author_name" value="{{ old('author_name') }}" placeholder="Masukkan nama Anda">
                        @error('author_name')
                            <div class="invalid-feedback fw-bold">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label fw-bold">Isi Komentar <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4" placeholder="Tulis komentar Anda di sini...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback fw-bold">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm"><i class="fas fa-paper-plane me-2"></i>Kirim Komentar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
