<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Applicant;
use App\Models\Certification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminFtjsCertificationTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin(): Admin
    {
        $admin = Admin::create([
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        session(['admin_id' => $admin->id]);

        return $admin;
    }

    public function test_admin_can_fetch_ftjs_certificate_payload(): void
    {
        $this->actingAsAdmin();

        $applicant = Applicant::create([
            'email_address' => 'kyla@example.com',
            'fullname' => 'Kyla A. Lamanilao',
            'contact_number' => '09171234567',
            'address' => 'Sample St, Ozamiz City',
            'gender' => 'Female',
            'date_of_birth' => '2001-05-10',
            'status' => 'Active',
        ]);

        $certification = Certification::create([
            'applicant_id' => $applicant->id,
            'fullname' => 'Kyla A. Lamanilao',
            'barangay' => 'Aguada, Ozamiz City',
            'date_requested' => now()->toDateString(),
            'status' => 'Not Claimed',
        ]);

        $response = $this->getJson('/admin/certifications/'.$certification->id.'/certificate');

        $response->assertOk();
        $response->assertJsonFragment(['bearer_name' => 'KYLA A. LAMANILAO']);
        $response->assertJsonFragment(['confirm_name' => 'Ms. Lamanilao']);
        $response->assertJsonFragment(['pronoun_subject' => 'She']);
        $response->assertJsonFragment(['signatory_name' => 'JUDITH R. HALASAN']);
    }

    public function test_admin_can_open_ftjs_certificate_print_page(): void
    {
        $this->actingAsAdmin();

        $certification = Certification::create([
            'applicant_id' => null,
            'fullname' => 'Kyla A. Lamanilao',
            'barangay' => 'Aguada, Ozamiz City',
            'date_requested' => now()->toDateString(),
            'status' => 'Not Claimed',
        ]);

        $response = $this->get('/admin/certifications/'.$certification->id.'/certificate/print');

        $response->assertOk();
        $response->assertSee('C E R T I F I C A T I O N', false);
        $response->assertSee('KYLA A. LAMANILAO', false);
        $response->assertSee('ftjs-certification-print', false);
    }
}
