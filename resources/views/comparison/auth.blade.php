@extends('layouts.app')

@section('title', 'Lab Authentication & Password Security')

@section('content')
    <div class="mb-4">
        <h2 class="h4">
            <i class="fas fa-shield-alt text-primary me-2"></i> Lab Authentication & Password Security
        </h2>
    </div>

    <div class="py-4">
        <div class="container">
            <!-- Peringatan -->
            <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1 text-uppercase fw-bold" style="font-size: 0.9rem;">Peringatan Keamanan</h5>
                    <p class="mb-0 small">
                        Halaman "Vulnerable" mendemonstrasikan praktik autentikasi yang buruk secara sengaja untuk tujuan edukasi. <strong>JANGAN PERNAH</strong> mengimplementasikan pola autentikasi vulnerable ini pada aplikasi production Anda.
                    </p>
                </div>
            </div>

            <!-- Lab Objectives -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark mb-4">
                        <i class="fas fa-graduation-cap text-primary me-2"></i> Tujuan Pembelajaran Lab
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="text-secondary small">
                                <li class="mb-2">Memahami perbedaan authentication vs authorization</li>
                                <li class="mb-2">Mengimplementasikan login/register dengan standard framework</li>
                                <li class="mb-2">Memahami password hashing (bcrypt, Argon2) vs Plaintext</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="text-secondary small">
                                <li class="mb-2">Menerapkan rate limiting untuk mencegah brute force attack</li>
                                <li class="mb-2">Mengamankan konfigurasi session terhadap Hijacking</li>
                                <li class="mb-2">Menerapkan password validation rules yang kuat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perbandingan Flow -->
            <div class="row g-4 mb-4">
                
                <!-- VULNERABLE SIDE -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-danger h-100 position-relative">
                        <span class="badge bg-danger position-absolute top-0 end-0 rounded-start-0 rounded-bottom-0 rounded-bottom-start shadow-sm" style="border-bottom-left-radius: 4px;">VULNERABLE</span>
                        
                        <div class="card-body" style="background-color: #fffafb;">
                            <h4 class="card-title fw-bold text-danger mb-4">
                                <i class="fas fa-unlock-alt me-2"></i> Custom / Rentan
                            </h4>
                            
                            <div class="mb-4">
                                <div class="card mb-3 border-danger-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">1. Password Storage</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-danger font-monospace px-1 rounded" style="background-color: #fee2e2;">Plain text / MD5</span><br>
                                            Password langsung terbaca jika DB bocor.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="card mb-3 border-danger-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">2. Rate Limiting</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-danger font-monospace px-1 rounded" style="background-color: #fee2e2;">Tidak ada batas limits</span><br>
                                            Rentan terhadap Brute Force (ribuan coba/detik).
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="card mb-3 border-danger-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">3. Session Security</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-danger font-monospace px-1 rounded" style="background-color: #fee2e2;">No Regeneration</span><br>
                                            ID Session tetap sama, rentan Session Fixation.
                                        </p>
                                    </div>
                                </div>

                                <div class="card mb-3 border-danger-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">4. Password Validation</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-danger font-monospace px-1 rounded" style="background-color: #fee2e2;">Minimal (bahkan 123 bisa)</span><br>
                                            Tidak cek kompleksitas, panjang, / breached password.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('vulnerable.login') }}" class="btn btn-outline-danger shadow-sm flex-grow-1 fw-bold">
                                    Demo Login 
                                </a>
                                <a href="{{ route('vulnerable.register') }}" class="btn btn-danger shadow-sm flex-grow-1 fw-bold">
                                    Demo Register
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECURE SIDE -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-success h-100 position-relative">
                        <span class="badge bg-success position-absolute top-0 end-0 rounded-start-0 rounded-bottom-0 rounded-bottom-start shadow-sm" style="border-bottom-left-radius: 4px;">SECURE</span>
                        
                        <div class="card-body" style="background-color: #f6fcf8;">
                            <h4 class="card-title fw-bold text-success mb-4">
                                <i class="fas fa-shield-check me-2"></i> Laravel Standard
                            </h4>
                            
                            <div class="mb-4">
                                <div class="card mb-3 border-success-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">1. Password Storage</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-success font-monospace px-1 rounded" style="background-color: #dcfce7;">Bcrypt / Argon2</span><br>
                                            Hash lambat dan bergaram (Salted). Tidak bisa reverse.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="card mb-3 border-success-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">2. Rate Limiting</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-success font-monospace px-1 rounded" style="background-color: #dcfce7;">5 attempts / minute</span><br>
                                            Membuat Brute Force tidak praktis dilakukan.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="card mb-3 border-success-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">3. Session Security</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-success font-monospace px-1 rounded" style="background-color: #dcfce7;">Regenerate on Login</span><br>
                                            Cookie HTTPOnly, secure attribute.
                                        </p>
                                    </div>
                                </div>

                                <div class="card mb-3 border-success-subtle shadow-sm">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">4. Password Validation</h6>
                                        <p class="small text-muted mb-0">
                                            <span class="text-success font-monospace px-1 rounded" style="background-color: #dcfce7;">Min 8, Letters, Numbers</span><br>
                                            Opsi Uncompromised() dari HaveIBeenPwned.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                @if(Route::has('login'))
                                    <a href="{{ route('login') }}" class="btn btn-outline-success shadow-sm flex-grow-1 fw-bold">
                                        Real Login 
                                    </a>
                                @else
                                    <span class="btn btn-outline-secondary disabled flex-grow-1 fw-bold" title="Breeze not installed">
                                        Real Login (N/A)
                                    </span>
                                @endif
                                
                                @if(Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-success shadow-sm flex-grow-1 fw-bold">
                                        Real Register
                                    </a>
                                @else
                                    <span class="btn btn-secondary disabled flex-grow-1 fw-bold" title="Breeze not installed">
                                        Real Register (N/A)
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- OWASP Sec -->
            <div class="card bg-dark text-white shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://owasp.org/assets/images/logo.png" alt="OWASP Logo" height="30" class="me-3 bg-white p-1 rounded">
                        <h4 class="mb-0 fw-bold">OWASP Top 10 Reference</h4>
                    </div>
                    <p class="text-light-50 small mb-3">
                        Masalah ini terkait langsung dengan <strong>A07:2021 – Identification and Authentication Failures</strong>.
                    </p>
                    <div class="bg-secondary bg-opacity-25 p-3 rounded small">
                        <p class="font-monospace mb-2 text-info">"Confirm the application employs secure authentication and session management controls..."</p>
                        <ul class="text-light-50 mb-0">
                            <li>Where possible, implement multi-factor authentication (MFA).</li>
                            <li>Do not ship or deploy with default credentials.</li>
                            <li>Implement weak-password checks.</li>
                            <li>Align password length/complexity with standard guidelines (NIST).</li>
                            <li>Ensure registration/credential recovery resists enumeration attacks.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
