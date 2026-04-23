@extends('layouts.app')

@section('title', 'Basic File Upload - Security Lab')

@section('content')
<div class="mb-4">
    <h2 class="h4">
        <i class="fas fa-file text-secondary me-2"></i> File Upload Basic Demo
    </h2>
</div>

<div class="py-4">
    <div class="container">
        
        <div class="card shadow-sm border-0 mb-4 rounded-4">
            <div class="card-body p-5 text-center">
                <i class="fas fa-code text-secondary fa-3x mb-3"></i>
                <h4 class="fw-bold mb-3">Struktur HTML Dasar</h4>
                <p class="text-secondary mx-auto mb-4" style="max-width: 600px;">
                    Untuk mengirim file melalui form HTML ke server, form wajib memiliki atribut tambahan berupa <code>enctype="multipart/form-data"</code>. Tanpanya, PHP/Laravel hanya akan menerima string nama filenya saja, bukan jasad filenya.
                </p>

                <div class="bg-dark text-success p-3 rounded-3 text-start mx-auto font-monospace small shadow-sm" style="max-width: 600px;">
                    &lt;<span class="text-primary">form</span> <span class="text-info">action</span>=<span class="text-warning">"/upload"</span> <span class="text-info">method</span>=<span class="text-warning">"POST"</span> <strong><span class="text-danger">enctype</span>=<span class="text-warning">"multipart/form-data"</span></strong>&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&lt;<span class="text-primary">input</span> <span class="text-info">type</span>=<span class="text-warning">"file"</span> <span class="text-info">name</span>=<span class="text-warning">"document"</span>&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&lt;<span class="text-primary">button</span> <span class="text-info">type</span>=<span class="text-warning">"submit"</span>&gt;Upload&lt;/<span class="text-primary">button</span>&gt;<br>
                    &lt;/<span class="text-primary">form</span>&gt;
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8 mx-auto">
                <div class="card shadow border-0">
                    <div class="card-header bg-secondary text-white fw-bold">
                        Visualisasi UI Form
                    </div>
                    <div class="card-body p-4 bg-light">
                        <form onsubmit="event.preventDefault(); alert('Ini hanya demo form Basic. Tidak akan memproses upload. Lanjut ke bagian Vulnerable atau Secure untuk mengujinya langsung!');">
                            <div class="mb-3">
                                <label for="formFile" class="form-label fw-bold">Pilih Berkas Pengajuan</label>
                                <input class="form-control form-control-lg" type="file" id="formFile">
                                <div class="form-text mt-2"><i class="fas fa-info-circle me-1"></i>Ini adalah tampilan input bawaan Bootstrap.</div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-secondary btn-lg">Kirim Berkas (Simulasi)</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <a href="{{ route('upload-lab.vulnerable') }}" class="btn btn-danger px-4 rounded-pill fw-bold shadow-sm">Uji ke Sistem Rentan (Vulnerable) <i class="fas fa-skull ms-2"></i></a>
        </div>

    </div>
</div>
@endsection
