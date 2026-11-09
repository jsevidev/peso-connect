<?php

namespace App\Support;

use App\Models\Applicant;
use App\Models\Employer;
use App\Models\Referral;
use Carbon\Carbon;

class ReferralLetter
{
    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    public static function compose(?Referral $referral = null, array $overrides = []): array
    {
        $config = config('peso-referral-letter');

        $referral?->loadMissing(['applicant', 'employerRecord']);
        $applicant = $referral?->applicant;
        $employer = $referral?->employerRecord;

        if (! empty($overrides['employer_id']) && ! $employer) {
            $employer = Employer::find($overrides['employer_id']);
        }

        if (! empty($overrides['applicant_id']) && ! $applicant) {
            $applicant = Applicant::find($overrides['applicant_id']);
        }

        $profile = self::profileFromSources($referral, $applicant, $overrides);

        $recipientName = $employer?->contact_person
            ?? $overrides['recipient_name']
            ?? $referral?->recipient_name
            ?? '';

        $company = $overrides['employer']
            ?? $overrides['company']
            ?? $referral?->employer
            ?? $employer?->name
            ?? '';

        $city = $overrides['recipient_city']
            ?? $referral?->recipient_city
            ?? self::cityFromAddress($employer?->address)
            ?? $config['default_city'];

        $position = $overrides['job']
            ?? $overrides['position']
            ?? $referral?->job_title
            ?? '';

        $candidateName = $profile['name']
            ?? $overrides['name']
            ?? $overrides['candidate_name']
            ?? $referral?->fullname
            ?? '';

        $gender = $profile['gender'] ?? null;
        $date = self::parseDate($overrides['letter_date'] ?? $referral?->created_at ?? now());

        return [
            'referral_id' => $referral?->id,
            'applicant_id' => $referral?->applicant_id,
            'employer_id' => $referral?->employer_id ?? $employer?->id,
            'from_submission' => (bool) $referral?->applicant_id,
            'date_display' => $date->format('d F Y'),
            'recipient_name' => strtoupper(trim($recipientName)),
            'recipient_title' => $overrides['recipient_title'] ?? 'Manager',
            'company' => $company,
            'city' => $city,
            'position' => $position,
            'candidate_name' => $candidateName,
            'candidate_display' => self::candidateDisplayName($candidateName, $gender),
            'pronoun_subject' => self::pronounSubject($gender),
            'pronoun_possessive' => self::pronounPossessive($gender),
            'born' => $profile['born'] ?? '—',
            'address' => $profile['address'] ?? '—',
            'phone' => $profile['phone'] ?? '—',
            'email' => $profile['email'] ?? '—',
            'education' => $profile['education'] ?? '—',
            'skills' => $profile['skills'] ?? '—',
            'gender' => $gender,
            'birth_date' => $profile['birth_date'] ?? null,
            'signatory_name' => $config['signatory']['name'],
            'signatory_title' => $config['signatory']['title'],
            'footer' => $config['footer'],
            'letterhead_logos' => $config['letterhead']['logos'],
        ];
    }

    public static function fromReferral(Referral $referral): array
    {
        return self::compose($referral);
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private static function profileFromSources(?Referral $referral, ?Applicant $applicant, array $overrides): array
    {
        $stored = is_array($referral?->candidate_profile) ? $referral->candidate_profile : [];

        $base = $applicant
            ? [
                'name' => $applicant->fullname,
                'gender' => $applicant->gender,
                'birth_date' => $applicant->date_of_birth?->format('Y-m-d'),
                'born' => self::formatBorn($applicant->date_of_birth),
                'address' => $applicant->address,
                'phone' => $applicant->contact_number,
                'email' => $applicant->email_address,
                'education' => $applicant->education,
                'skills' => $applicant->skills,
            ]
            : [
                'name' => $stored['name'] ?? $referral?->fullname ?? '',
                'gender' => $stored['gender'] ?? null,
                'birth_date' => $stored['birth_date'] ?? null,
                'born' => self::formatBorn($stored['birth_date'] ?? null),
                'address' => $stored['address'] ?? null,
                'phone' => $stored['phone'] ?? null,
                'email' => $stored['email'] ?? null,
                'education' => $stored['education'] ?? null,
                'skills' => $stored['skills'] ?? null,
            ];

        return self::mergeLetterProfile($base, $stored, $overrides);
    }

    /**
     * @param  array<string, mixed>  $base
     * @param  array<string, mixed>  $stored
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private static function mergeLetterProfile(array $base, array $stored, array $overrides): array
    {
        $keys = ['name', 'gender', 'birth_date', 'address', 'phone', 'email', 'education', 'skills'];

        foreach ($keys as $key) {
            if (array_key_exists($key, $overrides) && self::filled($overrides[$key])) {
                $base[$key] = $overrides[$key];
            } elseif (array_key_exists($key, $stored) && self::filled($stored[$key])) {
                $base[$key] = $stored[$key];
            }
        }

        $birth = $base['birth_date'] ?? null;
        $base['birth_date'] = $birth instanceof \DateTimeInterface
            ? $birth->format('Y-m-d')
            : (is_string($birth) && $birth !== '' ? $birth : null);
        $base['born'] = self::formatBorn($base['birth_date']);

        return $base;
    }

    private static function filled(mixed $value): bool
    {
        if ($value === null) {
            return false;
        }

        if (is_string($value)) {
            return trim($value) !== '';
        }

        return true;
    }

    private static function parseDate(mixed $value): Carbon
    {
        if ($value instanceof Carbon) {
            return $value;
        }

        if ($value instanceof \DateTimeInterface) {
            return Carbon::instance($value);
        }

        return Carbon::parse($value);
    }

    private static function formatBorn(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return self::parseDate($value)->format('F j, Y');
    }

    private static function cityFromAddress(?string $address): ?string
    {
        if (! $address) {
            return null;
        }

        if (preg_match('/Ozamiz\s*City/i', $address)) {
            return 'Ozamiz City';
        }

        $parts = array_map('trim', explode(',', $address));

        return $parts !== [] ? end($parts) : null;
    }

    private static function candidateDisplayName(string $name, ?string $gender): string
    {
        $name = trim($name);
        if ($name === '') {
            return 'The registrant';
        }

        $honorific = match (strtolower((string) $gender)) {
            'female', 'f' => 'Ms.',
            'male', 'm' => 'Mr.',
            default => '',
        };

        return trim($honorific.' '.$name);
    }

    private static function pronounSubject(?string $gender): string
    {
        return match (strtolower((string) $gender)) {
            'female', 'f' => 'She',
            'male', 'm' => 'He',
            default => 'The registrant',
        };
    }

    private static function pronounPossessive(?string $gender): string
    {
        return match (strtolower((string) $gender)) {
            'female', 'f' => 'her',
            'male', 'm' => 'his',
            default => 'their',
        };
    }
}
