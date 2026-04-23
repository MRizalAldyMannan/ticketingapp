@extends('layouts.app')

@section('title', 'Demo XSS - Security Lab')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Demontrasi Cross-Site Scripting (XSS)</h2>
        <p class="lead">Halaman ini mendemonstrasikan perbedaan krusial antara output mentah (*raw*) dan output yang sudah difilter (*escaped*) di dalam kerangka kerja Laravel.</p>
        <div class="alert alert-info">
            <strong>Apa itu XSS?</strong> Cross-Site Scripting adalah kerentanan keamanan di mana peretas (attacker) mampu menyuntikkan dan mengeksekusi skrip sisi klien (biasanya JavaScript) yang berbahaya ke dalam halaman web yang dilihat oleh pengguna lain.
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-primary h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Aman (Escaped Output)</h5>
            </div>
            <div class="card-body">
                <p>Menggunakan sintaks kurung kurawal ganda bawaan Laravel yaitu <code>@{{ $input }}</code> akan secara otomatis memfilter *(escape)* entitas HTML, sehingga benar-benar aman dari eksekusi siluman.</p>
                <hr>
                <h6>Hasil Eksekusi:</h6>
                <div class="p-3 bg-light border rounded text-break">
                    {{ $input }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-danger h-100">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Rentan Bahaya (Raw Output)</h5>
            </div>
            <div class="card-body">
                <p>Menggunakan sintaks output mentah milik Laravel yaitu <code>{!! $input !!}</code> akan me-render bahasa HTML / JavaScript secara telanjang dan langsung, yang merupakan jalan pintas terjadinya injeksi.</p>
                <hr>
                <h6>Hasil Eksekusi:</h6>
                <div class="p-3 bg-light border rounded border-danger">
                    <!-- The following line renders raw input -->
                    {{ $input }}
                    <p class="text-muted small mt-2 text-danger">(Peringatan: Apabila payload memuat elemen script, browser akan segera merundung dan mengeksekusinya tanpa saringan! Coba periksa console browser Anda.)</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card border-secondary shadow-sm">
            <div class="card-body bg-light">
                <h6 class="mb-3 text-secondary fw-bold"><i class="fas fa-hammer me-2"></i>Coba Kirim Serangan:</h6>
                <form action="{{ route('security.xss') }}" method="GET" class="d-flex align-items-center">
                    <input type="text" name="payload" class="form-control me-2" value="{{ $input }}" placeholder="Ketik sesuatu, gunakan tag HTML seperti <h1> atau <script> ...">
                    <button type="submit" class="btn btn-secondary text-nowrap"><i class="fas fa-play me-2"></i>Uji Payload</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
