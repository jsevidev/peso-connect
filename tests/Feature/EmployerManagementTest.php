<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Employer;
use App\Models\JobPosting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployerManagementTest extends TestCase
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

    public function test_admin_can_create_employer_and_link_job_posting(): void
    {
        $admin = $this->actingAsAdmin();

        $response = $this->post('/admin/employers', [
            'name' => 'Accenture Philippines',
            'contact_person' => 'HR Team',
            'contact_email' => 'hr@accenture.com',
            'peso_verified' => '1',
        ]);

        $response->assertRedirect(route('admin.employers.index'));

        $employer = Employer::where('name', 'Accenture Philippines')->first();
        $this->assertNotNull($employer);
        $this->assertTrue($employer->peso_verified);

        $jobResponse = $this->post('/admin/jobs', [
            'title' => 'Support Specialist',
            'employer_id' => $employer->id,
            'location' => 'Pasay City',
            'salary_min' => '18000',
            'salary_max' => '22000',
            'type' => 'Full-Time',
            'description' => 'Handle customer support tickets.',
        ]);

        $jobResponse->assertRedirect(route('admin.jobs.index'));

        $job = JobPosting::first();
        $this->assertSame($employer->id, $job->employer_id);
        $this->assertSame('Accenture Philippines', $job->company);

        $publicResponse = $this->get('/jobs');
        $publicResponse->assertOk();
        $publicResponse->assertSee('Support Specialist');
        $publicResponse->assertSee('Accenture Philippines');
    }

    public function test_guest_cannot_access_employer_management(): void
    {
        $this->get('/admin/employers')->assertRedirect(route('admin.login'));
    }
}
