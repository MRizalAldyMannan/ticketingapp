<x-app-layout>
    @section('title', 'User Dashboard - Security Lab')

    <div class="container mt-4 mb-5">
        <!-- Hero Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="p-5 text-white rounded-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #c2410c, #ea580c); border: 1px solid #f97316;">
                    <div class="position-relative z-1">
                        <div class="mb-3">
                            <span class="badge bg-warning bg-opacity-25 border border-warning px-3 py-2 rounded-pill"><i class="fas fa-user text-light me-2"></i>Standard User Access</span>
                        </div>
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-laptop-code text-light me-3"></i>Dashboard Pengguna
                        </h1>
                        <p class="col-md-9 fs-5 text-light opacity-75">
                            Halo, <strong class="text-white">{{ Auth::user()->name ?? 'User' }}</strong>! Laporkan kendala Anda melalui sistem tiket atau pelajari modul keamanan siber di lab ini.
                        </p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('tickets.index') }}" class="btn btn-warning btn-lg px-4 shadow-sm rounded-pill border-0 text-dark" style="background-color: #fb923c;">
                                <i class="fas fa-ticket-alt me-2"></i>Tiket Saya
                            </a>
                            <a href="{{ route('security.xss') }}" class="btn btn-outline-light btn-lg px-4 shadow-sm rounded-pill">
                                <i class="fas fa-book-open me-2"></i>Modul Belajar
                            </a>
                        </div>
                    </div>
                    <!-- Decorative Background Icon -->
                    <i class="fas fa-user-graduate position-absolute text-white opacity-10" style="font-size: 15rem; right: -2rem; bottom: -3rem; transform: rotate(-15deg);"></i>
                </div>
            </div>
        </div>

        <!-- System Status Info -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4" style="background-color: #f8f9fa; border-left: 5px solid #fd7e14 !important;">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-3 rounded-circle shadow-sm me-3">
                                <i class="fas fa-shield-alt text-warning fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Koneksi Aman</h5>
                                <p class="mb-0 text-muted small">Anda sedang menjelajah dengan level akses standar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
