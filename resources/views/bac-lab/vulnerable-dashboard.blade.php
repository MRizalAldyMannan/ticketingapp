@extends('layouts.app')

@section('title', 'Vulnerable Dashboard - Security Lab')

@section('content')
<div class="mb-4">
    <div class="alert alert-danger shadow-sm border-0 d-flex align-items-center mb-0 rounded-0 rounded-top" role="alert">
        <i class="fas fa-skull-crossbones fs-3 me-3"></i>
        <div>
            <h5 class="mb-0 fw-bold text-uppercase">INCIDENT DETECTED: UNAUTHORIZED ACCESS</h5>
            <p class="mb-0 small">Anda ({{ auth()->user()->email }}) sebenarnya BUKAN Administrator, namun karena kerentanan BAC, Anda bisa membuka halaman rahasia ini!</p>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center bg-dark text-white p-4 rounded-3 shadow">
                <div>
                    <span class="badge bg-danger mb-2">RESTRICTED ZONE (BYPASSED)</span>
                    <h3 class="fw-bold mb-0"><i class="fas fa-server text-danger me-2"></i> Master Admin Control Panel</h3>
                </div>
                <div class="text-end">
                    <p class="text-secondary small mb-0">System Date</p>
                    <h5 class="mb-0">{{ now()->format('Y-m-d H:i') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Rahasia -->
    <h5 class="fw-bold text-danger mb-3"><i class="fas fa-user-secret me-2"></i> Data Paling Rahasia Sistem (BOCOR)</h5>
    <div class="row g-4 mb-5">
        @foreach($fakeSensitiveData as $data)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-danger border-opacity-50" style="background-color: #fff5f5;">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark">{{ $data['name'] }}</h5>
                    <p class="text-muted small mb-3">ID Config: {{ $data['id'] }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-danger p-2">{{ $data['status'] }}</span>
                        <button class="btn btn-sm btn-outline-danger" onclick="alert('Berhasil dieksekusi oleh penyusup!')">Manipulasi <i class="fas fa-wrench ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card bg-white border-0 shadow-sm rounded-4">
        <div class="card-body p-5 text-center">
            <i class="fas fa-exclamation-triangle text-warning fa-4x mb-3"></i>
            <h4 class="fw-bold">Kenapa Ini Bisa Terjadi?</h4>
            <p class="text-secondary mx-auto" style="max-width: 600px;">
                Saat halaman ini dirender, Programmer lupa menempatkan kode pengecekan otorisasi *(Authorization Check)* di level Controller/Router. Mereka mungkin hanya menyembunyikan "tombol" link dari layar pengguna, tetapi lupa mengunci Pintunya.
            </p>
            <a href="{{ route('bac-lab.comparison') }}" class="btn btn-dark mt-3">Kembali ke Comparison</a>
        </div>
    </div>
</div>
@endsection
