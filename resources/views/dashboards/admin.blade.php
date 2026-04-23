<x-app-layout>
    @section('title', 'Admin Dashboard - Security Lab')

    <div class="container mt-4 mb-5">
        <!-- Hero Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="p-5 text-white rounded-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #064e3b, #065f46); border: 1px solid #047857;">
                    <div class="position-relative z-1">
                        <div class="mb-3">
                            <span class="badge bg-success bg-opacity-25 border border-success px-3 py-2 rounded-pill"><i class="fas fa-crown text-warning me-2"></i>Administrator Privileges</span>
                        </div>
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-shield-halved text-success me-3"></i>Dashboard Administrator
                        </h1>
                        <p class="col-md-9 fs-5 text-light opacity-75">
                            Selamat datang, <strong class="text-white">{{ Auth::user()->name ?? 'Admin' }}</strong>! Anda memiliki kontrol penuh atas seluruh sistem dan pengguna.
                        </p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('tickets.index') }}" class="btn btn-success btn-lg px-4 shadow-sm rounded-pill border-0" style="background-color: #10b981;">
                                <i class="fas fa-users-cog me-2"></i>Manage Users & Tickets
                            </a>
                            <a href="{{ route('sqli-lab.index') }}" class="btn btn-outline-light btn-lg px-4 shadow-sm rounded-pill">
                                <i class="fas fa-database me-2"></i>Database Controls
                            </a>
                        </div>
                    </div>
                    <!-- Decorative Background Icon -->
                    <i class="fas fa-user-shield position-absolute text-white opacity-10" style="font-size: 15rem; right: -2rem; bottom: -3rem; transform: rotate(-15deg);"></i>
                </div>
            </div>
        </div>

        <!-- System Status Info -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4" style="background-color: #f8f9fa; border-left: 5px solid #198754 !important;">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-3 rounded-circle shadow-sm me-3">
                                <i class="fas fa-server text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">System Status O.K.</h5>
                                <p class="mb-0 text-muted small">All systems operational. Admin access verified.</p>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-link me-1"></i> SECURE ADMIN CONNECTION
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
