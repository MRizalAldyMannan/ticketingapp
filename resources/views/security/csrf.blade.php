@extends('layouts.app')

@section('title', 'Demo CSRF - Security Lab')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Cross-Site Request Forgery (CSRF)</h2>
        <p class="lead">Halaman ini mendemonstrasikan mekanisme perlindungan CSRF bawaan kerangka kerja Laravel.</p>
        <div class="alert alert-info">
            <strong>Apa itu CSRF?</strong> CSRF adalah serangan yang memaksa pengguna akhir untuk tanpa sadar mengeksekusi tindakan yang tidak diinginkan pada aplikasi web di mana mereka saat ini berstatus login (terautentikasi).
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-success h-100">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Formulir Aman (Dengan @csrf)</h5>
            </div>
            <div class="card-body">
                <p>Formulir ini menyertakan token <code>@csrf</code> eksklusif bawaan Laravel, yang memastikan bahwa permintaan (request) benar-benar berasal dari aplikasi kita sendiri.</p>
                <form action="{{ route('security.csrf.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Data Uji Coba</label>
                        <input type="text" name="data" class="form-control" value="Input yang Aman">
                    </div>
                    <button type="submit" class="btn btn-success">Kirim dengan Aman</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-danger h-100">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Formulir Rentan (Tanpa @csrf)</h5>
            </div>
            <div class="card-body">
                <p>Formulir ini TIDAK menyertakan token CSRF. Menyerahkan form ini akan menghasilkan pesan error <code>419 Page Expired</code>, yang membuktikan bagaimana sistem pelindung otomatis Laravel bekerja.</p>
                <form action="{{ route('security.csrf.submit') }}" method="POST">
                    <!-- Sengaja menghilangkan @csrf -->
                    <div class="mb-3">
                        <label class="form-label">Data Uji Coba</label>
                        <input type="text" name="data" class="form-control" value="Input yang Rentan">
                    </div>
                    <button type="submit" class="btn btn-danger">Kirim (Pasti Gagal)</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
