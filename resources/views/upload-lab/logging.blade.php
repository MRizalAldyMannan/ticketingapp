@extends('layouts.app')

@section('title', 'Server Security Logs - Security Lab')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">
            <i class="fas fa-terminal text-info me-2"></i> Security Server Logs (A09)
        </h2>
        <div>
            <span class="badge bg-dark px-3 py-2"><i class="far fa-clock me-1"></i> Live Tracking</span>
        </div>
    </div>
</div>

<div class="py-2">
    <div class="container">
        
        <div class="alert alert-info border-info shadow-sm d-flex align-items-center mb-4">
            <i class="fas fa-info-circle fs-3 me-3 text-info"></i>
            <div>
                <h6 class="fw-bold mb-1">Insufficient Logging & Monitoring</h6>
                <p class="mb-0 small">Mencatat aktivitas (Logging) adalah hal yang krusial. Tanpa adanya Logs, Anda tidak akan pernah tahu kapan server Anda diserang dan siapa pelakunya. Di bawah ini adalah simulasi pembacaan file <code>laravel.log</code> dari sistem.</p>
            </div>
        </div>

        <div class="card bg-dark text-success font-monospace shadow-lg rounded-4 overflow-hidden border border-secondary border-opacity-50">
            <div class="card-header bg-black py-2 d-flex gap-2 border-bottom border-secondary border-opacity-50">
                <span style="height: 12px; width: 12px; background-color: #ff5f56; border-radius: 50%;"></span>
                <span style="height: 12px; width: 12px; background-color: #ffbd2e; border-radius: 50%;"></span>
                <span style="height: 12px; width: 12px; background-color: #27c93f; border-radius: 50%;"></span>
                <span class="text-white-50 ms-3" style="font-size: 0.8rem;">root@security-server: /var/log/app.log</span>
            </div>
            <div class="card-body p-4" style="height: 400px; overflow-y: auto;">
                @if(count($logs) > 0)
                    @foreach($logs as $log)
                        <div class="mb-2 border-bottom border-secondary border-opacity-25 pb-2">
                            <span class="text-white-50">[{{ $log['time'] }}]</span> 
                            ENV.
                            @if($log['level'] === 'SECURITY')
                                <span class="bg-success text-dark px-1 fw-bold">SECURITY:</span> 
                            @elseif($log['level'] === 'INFO')
                                <span class="bg-info text-dark px-1 fw-bold">INFO:</span> 
                            @elseif($log['level'] === 'DANGER')
                                <span class="bg-danger text-white px-1 fw-bold">DANGER:</span> 
                            @else
                                <span class="bg-warning text-dark px-1 fw-bold">{{ $log['level'] }}:</span> 
                            @endif
                            <span class="text-light ms-2">{{ $log['message'] }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-secondary h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-file-code fa-3x mb-3 opacity-25"></i>
                        <p>Belum ada aktivitas file upload terdeteksi dari sesi ini.<br>Silakan lakukan percobaan pada menu unggah berikutnya.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4 text-end">
            <a href="{{ route('upload-lab.basic') }}" class="btn btn-outline-primary px-4 rounded-pill">Test Basic Form <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</div>
@endsection
