@extends('layouts.app')

@section('title', 'Secure Dashboard - Security Lab')

@section('content')
<div class="mb-4">
    <div class="alert alert-success shadow-sm border-0 d-flex align-items-center mb-0 rounded-0 rounded-top" role="alert">
        <i class="fas fa-shield-check fs-3 me-3"></i>
        <div>
            <h5 class="mb-0 fw-bold text-uppercase">SECURE CONNECTION ESTABLISHED</h5>
            <p class="mb-0 small">Kredensial Otorisasi Anda ({{ auth()->user()->email }}) divalidasi dengan sukses oleh Server.</p>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center bg-dark text-white p-4 rounded-3 shadow">
                <div>
                    <span class="badge bg-success mb-2">AUTHORIZED ADMIN ZONE</span>
                    <h3 class="fw-bold mb-0"><i class="fas fa-server text-success me-2"></i> Master Admin Control Panel</h3>
                </div>
                <div class="text-end">
                    <p class="text-secondary small mb-0">System Date</p>
                    <h5 class="mb-0">{{ now()->format('Y-m-d H:i') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Rahasia -->
    <h5 class="fw-bold text-success mb-3"><i class="fas fa-user-secret me-2"></i> Data Paling Rahasia Sistem (TERLINDUNGI)</h5>
    <div class="row g-4 mb-5">
        @foreach($secureSensitiveData as $data)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-success border-opacity-50" style="background-color: #f0fdf4;">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark">{{ $data['name'] }}</h5>
                    <p class="text-muted small mb-3">ID Config: {{ $data['id'] }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success p-2">{{ $data['status'] }}</span>
                        <button class="btn btn-sm btn-outline-success">Manage <i class="fas fa-wrench ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card bg-white border-0 shadow-sm rounded-4">
        <div class="card-body p-5 text-center">
            <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
            <h4 class="fw-bold">Mekanisme Otorisasi Berhasil!</h4>
            <p class="text-secondary mx-auto" style="max-width: 600px;">
                Jika Anda dapat membaca tulisan ini, berarti Anda sedang login menggunakan akun yang benar-benar wewenang Administrator (`admin@admin.com`).<br><br>
                <strong>Cobalah login dengan akun User biasa lalu paksakan masuk ke halaman `{{ request()->path() }}` ini, maka Anda akan diblokir total oleh server melalui pesan Error 403 Forbidden!</strong>
            </p>
            <a href="{{ route('bac-lab.comparison') }}" class="btn btn-dark mt-3">Kembali ke Comparison</a>
        </div>
    </div>
</div>
@endsection
