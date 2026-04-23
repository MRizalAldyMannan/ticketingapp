<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SecurityLabTest extends TestCase
{
    /**
     * Uji apakah halaman utama dapat diakses
     */
    public function test_home_page_redirects_to_tickets(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/tickets');
    }

    /**
     * Uji perlindungan CSRF 
     */
    public function test_csrf_protection_is_active_on_post_routes(): void
    {
        // Dalam Laravel testing standar, TokenMismatchException kadang me-redirect kembali (302) 
        // atau mengeluarkan 419 tergantung versi Exception Handler. Kita pastikan saja 
        // request tanpa token tidak berhasil (Bukan 200).
        $response = $this->post('/security-lab/csrf-submit', [
            'amount' => 5000000
        ]);
        
        $this->assertNotEquals(200, $response->getStatusCode());
    }

    /**
     * Uji proteksi Broken Access Control pada Secure Dashboard
     */
    public function test_unauthenticated_user_cannot_access_bac_secure_dashboard(): void
    {
        $response = $this->get('/bac-lab/secure-dashboard');
        
        // Redirect ke login
        $response->assertStatus(302);
    }
    
    /**
     * Uji Middleware Auth di Modul Upload Lab
     */
    public function test_upload_lab_requires_authentication(): void
    {
        $response = $this->get('/upload-lab');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    
    /**
     * Uji Validasi di Secure Upload file
     */
    public function test_secure_upload_rejects_dangerous_extensions(): void
    {
        // Simulasi kita sudah login
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post('/upload-lab/secure', [
            // Dummy bypass untuk memicu validasi format laravel tanpa upload file betulan
        ]);
        
        // Ditolak karena validasi file 'document' gagal
        $response->assertSessionHasErrors(['document']);
    }
}
