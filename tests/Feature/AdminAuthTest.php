<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_with_valid_credentials(): void
    {
        Admin::create([
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response = $this->post('/admin/login', [
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertNotNull(session('admin_id'));
    }

    public function test_admin_cannot_log_in_with_invalid_credentials(): void
    {
        Admin::create([
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response = $this->post('/admin/login', [
            'username' => 'admin',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHas('error');
        $this->assertNull(session('admin_id'));
    }

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect(route('admin.login'));
    }
}
