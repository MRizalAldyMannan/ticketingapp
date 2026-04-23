<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SecurityLabController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root to tickets index
Route::redirect('/', '/tickets')->name('home');

// Comparison Page
Route::get('/security-lab/auth-comparison', function() {
    return view('comparison.auth');
})->name('security.auth-comparison');

// Vulnerable Auth Routes
Route::prefix('vulnerable')->name('vulnerable.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\VulnerableAuth\VulnerableLoginController::class, 'create'])->name('login');
    Route::post('/login', [\App\Http\Controllers\VulnerableAuth\VulnerableLoginController::class, 'store'])->name('login.store');
    
    Route::get('/register', [\App\Http\Controllers\VulnerableAuth\VulnerableRegisterController::class, 'create'])->name('register');
    Route::post('/register', [\App\Http\Controllers\VulnerableAuth\VulnerableRegisterController::class, 'store'])->name('register.store');
});

// Ticket Management CRUD
Route::resource('tickets', TicketController::class)->except(['show']);

// Security Lab Concept Demos
Route::prefix('security-lab')->name('security.')->group(function () {
    Route::get('/xss', [SecurityLabController::class, 'xss'])->name('xss');
    Route::get('/csrf', [SecurityLabController::class, 'csrf'])->name('csrf');
    Route::post('/csrf-submit', [SecurityLabController::class, 'csrfSubmit'])->name('csrf.submit');
    Route::get('/headers', [SecurityLabController::class, 'headers'])->name('headers');
    
    // Validation Demo
    Route::get('/validation', [\App\Http\Controllers\CommentController::class, 'create'])->name('validation');
    Route::post('/validation', [\App\Http\Controllers\CommentController::class, 'store'])->name('validation.store');
});

// ================================================================
// CSRF LAB ROUTES (Minggu 3 Hari 3)
// ================================================================
use App\Http\Controllers\CsrfLabController;

Route::prefix('csrf-lab')->name('csrf-lab.')->group(function () {
    // Index - Menu Lab
    Route::get('/', [CsrfLabController::class, 'index'])->name('index');
    
    // How It Works - Penjelasan CSRF
    Route::get('/how-it-works', [CsrfLabController::class, 'howItWorks'])->name('how-it-works');
    
    // Attack Demo - Simulasi serangan
    Route::get('/attack-demo', [CsrfLabController::class, 'attackDemo'])->name('attack-demo');
    
    // Protection Demo - Demo protection
    Route::get('/protection-demo', [CsrfLabController::class, 'protectionDemo'])->name('protection-demo');
    
    // AJAX Demo - CSRF untuk AJAX
    Route::get('/ajax-demo', [CsrfLabController::class, 'ajaxDemo'])->name('ajax-demo');
    
    // ----- ACTION ROUTES -----
    
    // Secure transfer (dengan CSRF protection normal)
    Route::post('/secure-transfer', [CsrfLabController::class, 'secureTransfer'])->name('secure-transfer');
    
    // Protected action
    Route::post('/protected-action', [CsrfLabController::class, 'protectedAction'])->name('protected-action');
    
    // AJAX action
    Route::post('/ajax-action', [CsrfLabController::class, 'ajaxAction'])->name('ajax-action');
    
    // Reset demo data
    Route::post('/reset', [CsrfLabController::class, 'resetDemo'])->name('reset');
});

// VULNERABLE ROUTE (untuk demo - di-exclude dari CSRF middleware)
Route::post('/csrf-lab/vulnerable-transfer', [CsrfLabController::class, 'vulnerableTransfer'])
    ->name('csrf-lab.vulnerable-transfer')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Route untuk demo PROTECTED transfer (DENGAN CSRF - akan return 419 jika tanpa token)
Route::post('/csrf-lab/protected-transfer', [CsrfLabController::class, 'protectedTransfer'])
    ->name('csrf-lab.protected-transfer');

// ============================================
// SQL INJECTION LAB ROUTES (Minggu 3 Hari 4)
// ============================================
use App\Http\Controllers\SqliLabController;

Route::prefix('sqli-lab')->name('sqli-lab.')->group(function () {

    // Menu utama
    Route::get('/', [SqliLabController::class, 'index'])->name('index');

    // Halaman edukasi
    Route::get('/how-it-works', [SqliLabController::class, 'howItWorks'])->name('how-it-works');
    Route::get('/cheatsheet', [SqliLabController::class, 'cheatsheet'])->name('cheatsheet');

    // ============================================
    // VULNERABLE ENDPOINTS (UNTUK DEMO)
    // ============================================

    // Vulnerable Search - String concatenation
    Route::get('/vulnerable-search', [SqliLabController::class, 'vulnerableSearch'])
        ->name('vulnerable-search');

    // Vulnerable Login - Authentication bypass
    Route::get('/vulnerable-login', [SqliLabController::class, 'vulnerableLogin'])
        ->name('vulnerable-login');
    Route::post('/vulnerable-login', [SqliLabController::class, 'vulnerableLoginSubmit'])
        ->name('vulnerable-login-submit');

    // Blind SQL Injection Demo
    Route::get('/blind-sqli', [SqliLabController::class, 'blindSqli'])
        ->name('blind-sqli');
    Route::post('/blind-sqli/boolean', [SqliLabController::class, 'blindSqliBooleanCheck'])
        ->name('blind-sqli-boolean');
    Route::post('/blind-sqli/time', [SqliLabController::class, 'blindSqliTimeCheck'])
        ->name('blind-sqli-time');

    // ============================================
    // SECURE ENDPOINTS (BEST PRACTICE)
    // ============================================

    // Secure Search - 4 metode aman
    Route::get('/secure-search', [SqliLabController::class, 'secureSearch'])
        ->name('secure-search');

    // ============================================
    // UTILITY ROUTES
    // ============================================

    // Seed demo data
    Route::get('/seed-data', [SqliLabController::class, 'seedData'])
        ->name('seed');

    // Reset data
    Route::get('/reset-data', [SqliLabController::class, 'resetData'])
        ->name('reset');
});

// ============================================
// BROKEN ACCESS CONTROL (BAC) LAB ROUTES
// ============================================
use App\Http\Controllers\BacLabController;

Route::prefix('bac-lab')->middleware(['auth'])->name('bac-lab.')->group(function () {
    Route::get('/', [BacLabController::class, 'index'])->name('index');
    Route::get('/comparison', [BacLabController::class, 'comparison'])->name('comparison');
    
    // Ini bocor secara logic (akses semua orang)
    Route::get('/vulnerable-dashboard', [BacLabController::class, 'vulnerableDashboard'])->name('vulnerable-dashboard');
    
    // Ini aman (dijaga oleh if statment role === 'admin' di controller / bisa middleware)
    Route::get('/secure-dashboard', [BacLabController::class, 'secureDashboard'])->name('secure-dashboard');
});

// ============================================
// FILE UPLOAD & LOGGING LAB ROUTES (Module 6)
// ============================================
use App\Http\Controllers\UploadLabController;

Route::prefix('upload-lab')->middleware(['auth'])->name('upload-lab.')->group(function () {
    Route::get('/', [UploadLabController::class, 'index'])->name('index');
    Route::get('/logging', [UploadLabController::class, 'logging'])->name('logging');
    Route::get('/basic', [UploadLabController::class, 'basic'])->name('basic');
    
    // Vulnerable endpoints
    Route::get('/vulnerable', [UploadLabController::class, 'vulnerable'])->name('vulnerable');
    Route::post('/vulnerable', [UploadLabController::class, 'vulnerableSubmit'])->name('vulnerable-submit');
    
    // Secure endpoints
    Route::get('/secure', [UploadLabController::class, 'secure'])->name('secure');
    Route::post('/secure', [UploadLabController::class, 'secureSubmit'])->name('secure-submit');
});

// ============================================
// BREEZE ROUTES
// ============================================
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    
    if ($role === 'admin') {
        return view('dashboards.admin');
    } elseif ($role === 'staff') {
        return view('dashboards.staff');
    } else {
        return view('dashboards.user');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
