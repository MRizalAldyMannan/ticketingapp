@extends('layouts.app')

@section('title', 'BAC Comparison - Security Lab')

@section('content')
<div class="mb-4">
    <h2 class="h4">
        <i class="fas fa-code-branch text-primary me-2"></i> Broken Access Control Comparison
    </h2>
</div>

<div class="py-4">
    <div class="container">
        
        <!-- Peringatan -->
        <div class="alert alert-warning shadow-sm border-0 d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-exclamation-triangle fs-3 text-warning me-3"></i>
            <div>
                <h6 class="mb-1 fw-bold text-dark">Instruksi Pengujian</h6>
                <p class="mb-0 small text-dark opacity-75">Agar hasil eksperimen halaman ini valid, pastikan Anda sedang <strong>login sebagai pengguna biasa</strong> (`user@user.com`) bukan Admin.</p>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <!-- ARCHITECTURE 1: VULNERABLE -->
            <div class="col-md-6">
                <div class="card border-0 shadow h-100 rounded-4 overflow-hidden">
                    <div class="card-header bg-danger text-white p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold"><i class="fas fa-unlock text-light me-2"></i>Sistem Rentan (Vulnerable)</h4>
                            <span class="badge bg-white text-danger">Akses Lemah</span>
                        </div>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <p class="text-secondary mb-4">
                            Dalam skenario ini, pengembang (developer) hanya menghilangkan tombol "Menu Admin" dari tata letak untuk *user* biasa. Namun, rute/URL-nya dibiarkan terbuka.
                        </p>
                        
                        <div class="bg-light p-3 rounded-3 mb-4 font-monospace small border border-danger">
                            <span class="text-secondary">// Controller (Sangat Berbahaya)</span><br><br>
                            <span class="text-primary">public function</span> <span class="text-dark">adminDashboard</span>() {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-success">// Tidak ada pengecekan!</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-primary">return</span> view(<span class="text-danger">'admin.dashboard'</span>);<br>
                            }
                        </div>
                        
                        <p class="small text-danger fw-bold"><i class="fas fa-radiation me-1"></i> Dampak:</p>
                        <p class="small text-muted mb-4">Pengguna biasa hanya perlu mengetik <code>/bac-lab/vulnerable-dashboard</code> di kotak URL browser untuk mencuri data Admin dengan mudah!</p>

                        <div class="d-grid mt-auto">
                            <a href="{{ route('bac-lab.vulnerable-dashboard') }}" class="btn btn-outline-danger btn-lg rounded-3 fw-bold">Test Vulnerability <i class="fas fa-skull ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ARCHITECTURE 2: SECURE -->
            <div class="col-md-6">
                <div class="card border-0 shadow h-100 rounded-4 overflow-hidden">
                    <div class="card-header bg-success text-white p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold"><i class="fas fa-lock text-light me-2"></i>Sistem Kuat (Secure)</h4>
                            <span class="badge bg-white text-success">Server-Side Authorization</span>
                        </div>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <p class="text-secondary mb-4">
                            Dalam skenario ini, aplikasi tidak pernah mengandalkan UI yang tersembunyi. Pelacakan wewenang (*authorization check*) dilakukan langsung ke database setiap kali *endpoint* dipanggil.
                        </p>
                        
                        <div class="bg-light p-3 rounded-3 mb-4 font-monospace small border border-success">
                            <span class="text-secondary">// Controller (Kokoh)</span><br><br>
                            <span class="text-primary">public function</span> <span class="text-dark">secureDashboard</span>() {<br>
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-primary">if</span>(auth()->user()->role !== <span class="text-danger">'admin'</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">abort(403, 'Akses Ditolak')</span>;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-primary">return</span> view(<span class="text-danger">'admin.dashboard'</span>);<br>
                            }
                        </div>
                        
                        <p class="small text-success fw-bold"><i class="fas fa-shield-alt me-1"></i> Dampak:</p>
                        <p class="small text-muted mb-4">Meskipun URL ditebak atau dipaksakan, server langsung menendang keluar pengguna sebelum halaman dirender sama sekali.</p>

                        <div class="d-grid mt-auto">
                            <a href="{{ route('bac-lab.secure-dashboard') }}" class="btn btn-success btn-lg rounded-3 fw-bold shadow">Test Secure Route <i class="fas fa-check-circle ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
