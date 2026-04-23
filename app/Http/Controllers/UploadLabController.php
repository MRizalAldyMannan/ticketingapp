<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UploadLabController extends Controller
{
    /**
     * Tampilkan halaman Overview
     */
    public function index()
    {
        return view('upload-lab.index');
    }

    /**
     * Tampilkan halaman Logging Simulator
     */
    public function logging()
    {
        // Secara nyata, di production, log tersimpan di storage/logs/laravel.log
        // Untuk lab ini, kita simulasikan pembacaan security log.
        $logs = session()->get('security_logs', []);
        return view('upload-lab.logging', compact('logs'));
    }

    /**
     * Tampilkan halaman Basic Upload (Sekadar Form UI, tanpa fungsi proses)
     */
    public function basic()
    {
        return view('upload-lab.basic');
    }

    /**
     * Tampilkan halaman Vulnerable Upload
     */
    public function vulnerable()
    {
        return view('upload-lab.vulnerable');
    }

    /**
     * Eksekusi Vulnerable Upload (Menerima SEMUA tipe FIle)
     */
    public function vulnerableSubmit(Request $request)
    {
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            
            // BAHAYA: Hanya mengambil nama tanpa ekstensi check atau penyaringan mime.
            // BAHAYA: Tersimpan di dalam sistem public!
            $filename = $file->getClientOriginalName();
            
            // Mensimulasikan Log aktivitas lemah, tidak ada pencatatan IP atau level bahaya.
            $this->addLog('INFO', "User uploaded a file: {$filename}");
            
            return back()->with('success', "Berkas '{$filename}' berhasil diunggah ke /public/uploads/!");
        }

        return back()->with('error', 'Gagal mengunggah berkas.');
    }

    /**
     * Tampilkan halaman Secure Upload
     */
    public function secure()
    {
        return view('upload-lab.secure');
    }

    /**
     * Eksekusi Secure Upload (Menerapkan Whitelist, Max Size, MIME Verification)
     */
    public function secureSubmit(Request $request)
    {
        $request->validate([
            // Hanya izinkan format PDF dan Gambar, ukuran maksimal 2MB.
            'document' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048'
        ], [
            'document.mimes' => 'Pelanggaran Terdeteksi: Ekstensi harus berformat PDF, JPG, atau PNG.',
            'document.max' => 'Terlalu besar! Maksimal unggahan file adalah 2 Megabytes.'
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            
            // AMAN: Generate nama unik (Random String) untuk mencegah path traversal / eksekusi.
            $extension = $file->getClientOriginalExtension();
            $securedName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
            
            // Catat log keamanan dengan detail lengkap.
            $ip = $request->ip();
            $this->addLog('SECURITY', "Secure file upload by IP {$ip}. File saved as {$securedName}. Format validated.");

            return back()->with('success', "Berhasil! Berkas telah divalidasi MIME-nya dan direname dengan aman.");
        }

        return back()->with('error', 'File tidak ditemukan.');
    }

    /**
     * Helper Function: Tambahkan teks ke simulasi log
     */
    private function addLog($level, $message)
    {
        $logs = session()->get('security_logs', []);
        
        // Simpan hanya 15 log terakhir
        if (count($logs) > 15) {
            array_shift($logs);
        }
        
        $logs[] = [
            'time' => Carbon::now()->format('Y-m-d H:i:s'),
            'level' => $level,
            'message' => $message
        ];
        
        session()->put('security_logs', $logs);
        
        // Di kenyataan, ini mencatat ke laravel.log
        Log::info("[$level] $message");
    }
}
