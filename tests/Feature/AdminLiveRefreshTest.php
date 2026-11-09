<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Applicant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLiveRefreshTest extends TestCase
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

    public function test_guest_cannot_access_live_dashboard_fragment(): void
    {
        $this->get('/admin/live/dashboard', [
            'X-Live-Refresh' => '1',
        ])->assertRedirect(route('admin.login'));
    }

    public function test_live_dashboard_requires_refresh_header(): void
    {
        $this->actingAsAdmin();

        $this->get('/admin/live/dashboard')->assertNotFound();
    }

    public function test_admin_can_fetch_live_dashboard_fragment(): void
    {
        $this->actingAsAdmin();

        Applicant::create([
            'email_address' => 'live.test@example.com',
            'fullname' => 'Live Test Applicant',
            'contact_number' => '09171234567',
            'address' => 'Test address',
            'status' => 'Pending',
        ]);

        $response = $this->get('/admin/live/dashboard', [
            'X-Live-Refresh' => '1',
        ]);

        $response->assertOk();
        $response->assertSee('Total Enlistees');
        $response->assertSee('Live Test Applicant');
    }

    public function test_admin_can_fetch_live_enlistee_rows(): void
    {
        $this->actingAsAdmin();

        Applicant::create([
            'email_address' => 'rows.test@example.com',
            'fullname' => 'Rows Test Applicant',
            'contact_number' => '09179876543',
            'address' => 'Rows address',
            'status' => 'Pending',
        ]);

        $response = $this->get('/admin/live/enlistees', [
            'X-Live-Refresh' => '1',
        ]);

        $response->assertOk();
        $response->assertSee('Rows Test Applicant');
    }

    public function test_admin_can_fetch_live_upcoming_activities(): void
    {
        $admin = $this->actingAsAdmin();

        Announcement::create([
            'admin_id' => $admin->id,
            'slug' => 'ozamiz-job-fair-2026',
            'title' => 'Ozamiz City Job Fair',
            'description' => 'Local employers and PESO placement drive at City Hall.',
            'category' => 'Job Fair',
            'status' => 'Scheduled',
            'publish_date' => now()->addDays(3)->toDateString(),
            'scheduled_date' => now()->addDays(3)->toDateString(),
            'author_name' => 'PESO Ozamiz',
        ]);

        $response = $this->get('/admin/live/upcoming-activities', [
            'X-Live-Refresh' => '1',
        ]);

        $response->assertOk();
        $response->assertSee('Ozamiz City Job Fair');
    }
}
