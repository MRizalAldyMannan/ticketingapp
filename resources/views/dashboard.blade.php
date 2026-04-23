<x-app-layout>
    @section('title', 'Dashboard - Security Lab')

    <div class="container mt-4 mb-5">
        <!-- Hero Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="p-5 text-white rounded-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b, #0f172a); border: 1px solid #334155;">
                    <div class="position-relative z-1">
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-shield-halved text-success me-3"></i>Welcome to Security Lab
                        </h1>
                        <p class="col-md-9 fs-5 text-light opacity-75">
                            Hello, <strong class="text-white">{{ Auth::user()->name ?? 'User' }}</strong>! You are securely logged in. Explore the different modules of the lab to learn about web vulnerabilities and how to prevent them properly.
                        </p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('tickets.index') }}" class="btn btn-success btn-lg px-4 shadow-sm rounded-pill">
                                <i class="fas fa-ticket-alt me-2"></i>View Tickets
                            </a>
                            <a href="{{ route('sqli-lab.index') }}" class="btn btn-outline-light btn-lg px-4 shadow-sm rounded-pill">
                                <i class="fas fa-database me-2"></i>Explore SQLi Lab
                            </a>
                        </div>
                    </div>
                    <!-- Decorative Background Icon -->
                    <i class="fas fa-user-shield position-absolute text-white opacity-10" style="font-size: 15rem; right: -2rem; bottom: -3rem; transform: rotate(-15deg);"></i>
                </div>
            </div>
        </div>

        <!-- Modules Cards Section -->
        <h4 class="mb-3 fw-bold text-secondary"><i class="fas fa-layer-group me-2"></i>Available Learning Modules</h4>
        <div class="row g-4">
            <!-- Module 3: CSRF & XSS -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="transition: transform 0.2s;">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex p-3 mb-3">
                            <i class="fas fa-bug fa-2x text-danger"></i>
                        </div>
                        <h5 class="card-title fw-bold">XSS & CSRF (Mod 3)</h5>
                        <p class="card-text text-muted" style="font-size: 0.9rem;">Learn about Cross-Site Scripting and Cross-Site Request Forgery injection attacks.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 text-center">
                        <a href="{{ route('csrf-lab.index') }}" class="btn btn-outline-danger btn-sm rounded-pill px-4">Go to Module</a>
                    </div>
                </div>
            </div>
            
            <!-- Module 4: SQL Injection -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="transition: transform 0.2s;">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex p-3 mb-3">
                            <i class="fas fa-database fa-2x text-warning"></i>
                        </div>
                        <h5 class="card-title fw-bold">SQL Injection (Mod 4)</h5>
                        <p class="card-text text-muted" style="font-size: 0.9rem;">Understand how SQL Injection works and practice securing your raw database queries.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 text-center">
                        <a href="{{ route('sqli-lab.index') }}" class="btn btn-outline-warning btn-sm rounded-pill px-4 text-dark">Go to Module</a>
                    </div>
                </div>
            </div>

            <!-- Module: Auth Security -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="transition: transform 0.2s;">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex p-3 mb-3">
                            <i class="fas fa-lock fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title fw-bold">Auth Security</h5>
                        <p class="card-text text-muted" style="font-size: 0.9rem;">Compare vulnerable and secure authentication architecture implementations.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 text-center">
                        <a href="{{ route('security.auth-comparison') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">Go to Auth Lab</a>
                    </div>
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
                                <p class="mb-0 text-muted small">All labs and test environments are currently active. Safe session established.</p>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-link me-1"></i> SECURE CONNECTION
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .hover-lift:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>
    @endpush
</x-app-layout>
