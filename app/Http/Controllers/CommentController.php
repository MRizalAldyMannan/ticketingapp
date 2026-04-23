<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; // Pastikan model Comment sudah dibuat jika ini digunakan untuk menyimpan ke database

class CommentController extends Controller
{
    /**
     * Menampilkan halaman simulasi form validasi input.
     */
    public function create()
    {
        return view('security.validation');
    }

    /**
     * Menyimpan komentar yang dikirim dari form (Demonstrasi Keamanan Form)
     */
    public function store(Request $request)
    {
        // Custom error messages in Indonesian
        $messages = [
            'author_name.required' => 'Nama penulis wajib diisi! Jangan dikosongkan.',
            'author_name.string'   => 'Nama penulis harus berupa teks yang valid.',
            'author_name.max'      => 'Nama penulis maksimal 100 karakter.',
            'content.required'     => 'Isi komentar tidak boleh kosong!',
            'content.string'       => 'Isi komentar harus berupa teks yang valid.',
            'content.max'          => 'Isi komentar maksimal 1000 karakter.',
        ];

        // Tahap 1: Validasi input menggunakan aturan yang tepat dan pesan khusus
        $validatedData = $request->validate([
            'author_name' => 'required|string|max:100',
            'content'     => 'required|string|max:1000',
        ], $messages);

        // Tahap 2: Sanitasi input dengan fungsi strip_tags() sebelum disimpan
        $sanitizedAuthorName = strip_tags($validatedData['author_name']);
        $sanitizedContent    = strip_tags($validatedData['content']);

        // Mengembalikan response sukses beserta data yang sudah lewat sanitasi
        return redirect()->back()->with('success', 'Sukses! Berhasil lolos validasi. Data tersanitasi yang akan masuk database: Nama = "'.$sanitizedAuthorName.'"');
    }
}
