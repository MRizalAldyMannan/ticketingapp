<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BacLabController extends Controller
{
    /**
     * Tampilkan halaman Overview BAC
     */
    public function index()
    {
        return view('bac-lab.index');
    }

    /**
     * Tampilkan halaman Comparison (Aman vs Rentan)
     */
    public function comparison()
    {
        return view('bac-lab.comparison');
    }

    /**
     * Tampilkan Vulnerable Dashboard (TANPA PROTEKSI ROLE)
     * Hanya mewajibkan login biasa, sehingga siapapun bisa masuk.
     */
    public function vulnerableDashboard()
    {
        // Seharusnya ada pengecekan: if (auth()->user()->role !== 'admin') { abort(403); }
        // Namun karena ini page vulnerable, kita sengaja hilangkan agar bocor.
        
        $fakeSensitiveData = [
            ['id' => 101, 'name' => 'Server Core Config', 'status' => 'Active'],
            ['id' => 102, 'name' => 'Database Creds Backup', 'status' => 'Exposed'],
            ['id' => 103, 'name' => 'User Banking APIs', 'status' => 'Warning']
        ];
        
        return view('bac-lab.vulnerable-dashboard', compact('fakeSensitiveData'));
    }

    /**
     * Tampilkan Secure Dashboard (DENGAN PROTEKSI MULTI-ROLE)
     */
    public function secureDashboard()
    {
        // Pengecekan server-side (Di dunia nyata lebih baik menggunakan Middleware)
        if (auth()->user()->role !== 'admin') {
            abort(403, 'AKSES DITOLAK: Anda bukan Administrator. Insiden ini telah dicatat.');
        }

        $secureSensitiveData = [
            ['id' => 101, 'name' => 'Server Core Config', 'status' => 'Encrypted'],
            ['id' => 102, 'name' => 'Database Creds Backup', 'status' => 'Secured'],
            ['id' => 103, 'name' => 'User Banking APIs', 'status' => 'Protected']
        ];
        
        return view('bac-lab.secure-dashboard', compact('secureSensitiveData'));
    }
}
