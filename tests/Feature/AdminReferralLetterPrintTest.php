<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Referral;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminReferralLetterPrintTest extends TestCase
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

    public function test_admin_can_open_referral_letter_print_page(): void
    {
        $this->actingAsAdmin();

        $referral = Referral::create([
            'fullname' => 'Maria Clara Santos',
            'employer' => 'Sample Corp',
            'job_title' => 'Administrative Assistant',
            'status' => 'Approved',
        ]);

        $response = $this->get('/admin/referrals/'.$referral->id.'/letter/print');

        $response->assertOk();
        $response->assertSee('Referral Letter', false);
        $response->assertSee('Maria Clara Santos', false);
        $response->assertSee('referral-letter-print', false);
        $response->assertSee(now()->format('d F Y'), false);
    }
}
