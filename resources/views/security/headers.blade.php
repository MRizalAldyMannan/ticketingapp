@extends('layouts.app')

@section('title', 'Info Headers - Security Lab')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Info Keamanan Headers PENTING</h2>
        <p class="lead">Memahami header HTTP dasar yang sangat krusial dalam membantu mengamankan aplikasi web Anda.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-info">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">X-Frame-Options</h5>
            </div>
            <div class="card-body">
                <p>Digunakan untuk menginstruksikan kepada browser apakah sebuah halaman web diizinkan untuk dirender di dalam <code>&lt;frame&gt;</code>, <code>&lt;iframe&gt;</code>, <code>&lt;embed&gt;</code> atau <code>&lt;object&gt;</code> oleh situs lain.</p>
                <ul>
                    <li><strong>DENY</strong>: Halaman sama sekali tidak bisa ditampilkan di frame mana pun, dari situs apa pun.</li>
                    <li><strong>SAMEORIGIN</strong>: Halaman hanya bisa ditampilkan di dalam frame yang berasal dari domain atau situs web yang persis sama.</li>
                </ul>
                <p class="text-muted small">Sangat ampuh untuk mencegah serangan Clickjacking (manipulasi klik ghaib).</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Content-Security-Policy (CSP)</h5>
            </div>
            <div class="card-body">
                <p>Sebuah lapisan keamanan (layer) ekstra yang berfungsi besar mendeteksi sekaligus mencegah berbagai rentetan infeksi eksekusi, termasuk injeksi bahaya macam XSS.</p>
                <p>Polisi data ini membantu administrator mengatur agar browser HANYA bisa memuat gambar, aset, atau skrip dari lokasi yang sudah dideklarasikan aman (*whitelist*).</p>
                <code>default-src 'self'; img-src *;</code>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-secondary">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">X-Content-Type-Options</h5>
            </div>
            <div class="card-body">
                <p>Simbol penanda bagi browser yang memastikan bahwa status jenis data/file pada header <code>Content-Type</code> mutlak tidak boleh dipelintir dan diendus paksa (sniff) oleh browser.</p>
                <code>nosniff</code>
                <p class="text-muted small mt-2">Perlindungan wajib mencegah *MIME-sniffing*. Otomatis menutup jalan celah ketika suatu skrip jahat mencoba disamarkan seolah dia hanyalah file gambar/teks biasa.</p>
            </div>
        </div>
    </div>
</div>
@endsection
