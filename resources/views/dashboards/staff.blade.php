<x-app-layout>
    @section('title', 'Staff Dashboard - Security Lab')

    <div class="container mt-4 mb-5">
        <!-- Hero Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="p-5 text-white rounded-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a, #1d4ed8); border: 1px solid #2563eb;">
                    <div class="position-relative z-1">
                        <div class="mb-3">
                            <span class="badge bg-primary bg-opacity-25 border border-primary px-3 py-2 rounded-pill"><i class="fas fa-user-tie text-info me-2"></i>Staff / Operator Workspace</span>
                        </div>
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-headset text-info me-3"></i>Dashboard Staff
                        </h1>
                        <p class="col-md-9 fs-5 text-light opacity-75">
                            Halo, <strong class="text-white">{{ Auth::user()->name ?? 'Staff' }}</strong>! Pantau dan selesaikan tiket keluhan pengguna secara efisien dari halaman ini.
                        </p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('tickets.index') }}" class="btn btn-primary btn-lg px-4 shadow-sm rounded-pill border-0" style="background-color: #3b82f6;">
                                <i class="fas fa-clipboard-list me-2"></i>Kelola Antrean Tiket
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg px-4 shadow-sm rounded-pill">
                                <i class="fas fa-chart-line me-2"></i>Lihat Laporan
                            </a>
                        </div>
                    </div>
                    <!-- Decorative Background Icon -->
                    <i class="fas fa-briefcase position-absolute text-white opacity-10" style="font-size: 15rem; right: -1rem; bottom: -3rem; transform: rotate(-15deg);"></i>
                </div>
            </div>
        </div>

        <!-- System Status Info -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4" style="background-color: #f8f9fa; border-left: 5px solid #0d6efd !important;">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-3 rounded-circle shadow-sm me-3">
                                <i class="fas fa-check-circle text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Workspace Aktif</h5>
                                <p class="mb-0 text-muted small">Anda masuk sebagai operasional/staff.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
