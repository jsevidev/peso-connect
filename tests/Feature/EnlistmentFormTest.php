<?php

namespace Tests\Feature;

use App\Mail\AdminFormSubmitted;
use App\Models\Admin;
use App\Models\Applicant;
use App\Models\JobPosting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EnlistmentFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_enlistment_form_creates_applicant(): void
    {
        Mail::fake();

        $admin = Admin::create([
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        JobPosting::create([
            'admin_id' => $admin->id,
            'job_title' => 'Customer Service Representative',
            'company' => 'BPO Corp',
            'job_type' => 'Full-Time',
            'location' => 'Metro Manila',
            'job_description' => 'Handle customer inquiries.',
            'status' => 'Active',
        ]);

        $response = $this->post('/enlistment', [
            'job_position' => 'Customer Service Representative',
            'full_name' => 'Maria Santos',
            'address' => 'Barangay 1, Pasay City',
            'email' => 'maria.santos@example.com',
            'phone' => '09171234567',
            'education' => 'College Graduate',
            'skills' => 'Communication, MS Office',
        ]);

        $response->assertRedirect(route('enlistment'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('applicants', [
            'fullname' => 'Maria Santos',
            'email_address' => 'maria.santos@example.com',
            'status' => 'Pending',
        ]);

        Mail::assertSent(AdminFormSubmitted::class);
    }

    public function test_enlistment_form_shows_validation_errors(): void
    {
        $response = $this->from('/enlistment')->post('/enlistment', [
            'full_name' => '',
            'email' => 'not-an-email',
        ]);

        $response->assertRedirect('/enlistment');
        $response->assertSessionHasErrors(['job_position', 'full_name', 'email']);

        $this->assertSame(0, Applicant::count());
    }
}
