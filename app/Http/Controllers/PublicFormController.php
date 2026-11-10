<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Certification;
use App\Models\JobPosting;
use App\Models\Referral;
use App\Support\AdminNotifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicFormController extends Controller
{
    public function storeEnlistment(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'job_position' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'education' => ['required', 'string', 'max:255'],
            'skills' => ['required', 'string', 'max:2000'],
        ]);

        $submittedFromModal = $request->input('enlist_context') === 'modal';

        if ($validator->fails()) {
            $redirect = redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);

            if ($submittedFromModal) {
                $redirect->with('open_enlist_modal', true);
            }

            return $redirect;
        }

        $validated = $validator->validated();

        $jobPosting = JobPosting::where('job_title', $validated['job_position'])->first();

        Applicant::create([
            'job_posting_id' => $jobPosting?->id,
            'email_address' => $validated['email'],
            'fullname' => $validated['full_name'],
            'contact_number' => $validated['phone'],
            'address' => $validated['address'],
            'education' => $validated['education'],
            'skills' => $validated['skills'] ?? '',
            'position' => $validated['job_position'],
            'status' => 'Pending',
        ]);

        AdminNotifier::formSubmitted(
            'Enlistment',
            $validated['full_name'],
            'Position: '.$validated['job_position']
        );

        return redirect()
            ->back()
            ->with('status', 'Your enlistment has been submitted. PESO staff will review your application.');
    }

    public function storeReferral(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string'],
            'job_position' => ['required', 'string', 'max:255'],
            'education' => ['required', 'string', 'max:255'],
            'skills' => ['required', 'string'],
        ]);

        $jobPosting = JobPosting::where('job_title', $validated['job_position'])->first();

        $applicant = Applicant::create([
            'job_posting_id' => $jobPosting?->id,
            'email_address' => $validated['email'],
            'fullname' => $validated['full_name'],
            'contact_number' => $validated['phone'],
            'date_of_birth' => $validated['birth_date'],
            'address' => $validated['address'],
            'education' => $validated['education'],
            'skills' => $validated['skills'],
            'position' => $validated['job_position'],
            'status' => 'Pending',
        ]);

        Referral::create([
            'applicant_id' => $applicant->id,
            'job_posting_id' => $jobPosting?->id,
            'fullname' => $validated['full_name'],
            'job_title' => $validated['job_position'],
            'employer' => 'Pending Assignment',
            'status' => 'Pending Review',
        ]);

        AdminNotifier::formSubmitted(
            'Referral Request',
            $validated['full_name'],
            'Position: '.$validated['job_position']
        );

        return redirect()
            ->route('referral-requests')
            ->with('status', 'Your referral request has been submitted. PESO staff will contact you soon.');
    }

    public function storeCertification(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'sex' => ['required', 'string', 'max:20'],
            'civil_status' => ['required', 'string', 'max:50'],
            'mobile' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string'],
            'barangay' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'id_type' => ['required', 'string', 'max:100'],
            'filipino_citizen' => ['accepted'],
            'first_time_seeker' => ['accepted'],
            'actively_looking' => ['accepted'],
            'not_previously_availed' => ['accepted'],
            'certify_truth' => ['accepted'],
            'agree_oath' => ['accepted'],
        ]);

        $applicant = Applicant::create([
            'email_address' => $validated['email'],
            'fullname' => $validated['full_name'],
            'contact_number' => $validated['mobile'],
            'date_of_birth' => $validated['birth_date'],
            'gender' => $validated['sex'],
            'civil_status' => $validated['civil_status'],
            'address' => $validated['address'].', '.$validated['barangay'].', '.$validated['city'],
            'status' => 'Pending',
        ]);

        Certification::create([
            'applicant_id' => $applicant->id,
            'fullname' => $validated['full_name'],
            'barangay' => $validated['barangay'].', '.$validated['city'],
            'id_type' => $validated['id_type'],
            'date_requested' => now()->toDateString(),
            'status' => 'Pending',
        ]);

        AdminNotifier::formSubmitted(
            'FTJS Certification',
            $validated['full_name'],
            'Barangay: '.$validated['barangay'].', '.$validated['city']
        );

        return redirect()
            ->route('first-time-job-seeker')
            ->with('status', 'Your FTJS certification request has been submitted.');
    }
}
