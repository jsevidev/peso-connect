<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Employer;
use App\Models\Referral;
use App\Support\ReferralLetter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminReferralLetterBirthDateTest extends TestCase
{
    use RefreshDatabase;

    public function test_letter_uses_saved_birth_date_when_applicant_record_lacks_dob(): void
    {
        $employer = Employer::create([
            'name' => 'Sample Corp',
            'status' => 'Active',
        ]);

        $applicant = Applicant::create([
            'email_address' => 'test@example.com',
            'fullname' => 'Maria Clara Santos',
            'contact_number' => '09170000000',
            'address' => 'Ozamiz City',
            'status' => 'Active',
        ]);

        $referral = Referral::create([
            'applicant_id' => $applicant->id,
            'employer_id' => $employer->id,
            'fullname' => 'Maria Clara Santos',
            'job_title' => 'Clerk',
            'employer' => $employer->name,
            'status' => 'Pending Review',
            'candidate_profile' => [
                'name' => 'Maria Clara Santos',
                'birth_date' => '1999-06-05',
            ],
        ]);

        $letter = ReferralLetter::fromReferral($referral);

        $this->assertSame('1999-06-05', $letter['birth_date']);
        $this->assertSame('June 5, 1999', $letter['born']);
    }
}
