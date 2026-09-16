<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Employer;
use App\Models\JobPosting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicJobsTest extends TestCase
{
    use RefreshDatabase;

    public function test_jobs_page_lists_active_postings(): void
    {
        $admin = Admin::create([
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $employer = Employer::create([
            'name' => 'LGU Pasay',
            'abbr' => 'LGU',
            'status' => 'Active',
        ]);

        JobPosting::create([
            'admin_id' => $admin->id,
            'employer_id' => $employer->id,
            'job_title' => 'Administrative Assistant',
            'company' => 'LGU Pasay',
            'job_type' => 'Full-Time',
            'location' => 'Pasay City',
            'job_description' => 'Support office operations.',
            'status' => 'Active',
        ]);

        $response = $this->get('/jobs');

        $response->assertOk();
        $response->assertSee('Administrative Assistant');
        $response->assertSee('LGU Pasay');
    }
}
