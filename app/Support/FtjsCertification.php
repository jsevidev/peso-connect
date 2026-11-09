<?php

namespace App\Support;

use App\Models\Certification;
use Carbon\Carbon;

class FtjsCertification
{
    /**
     * @return array<string, mixed>
     */
    public static function compose(?Certification $certification = null): array
    {
        $config = config('peso-ftjs-certification');
        $certification?->loadMissing('applicant');

        $applicant = $certification?->applicant;
        $fullName = trim($certification?->fullname ?? $applicant?->fullname ?? '');
        $gender = $applicant?->gender ?? null;

        $issuedAt = $certification?->updated_at
            ?? $certification?->date_requested
            ?? now();

        $date = self::parseDate($issuedAt);

        return [
            'certification_id' => $certification?->id,
            'bearer_name' => $fullName !== '' ? mb_strtoupper($fullName) : '—',
            'confirm_name' => self::confirmName($fullName, $gender),
            'pronoun_subject' => self::pronounSubject($gender),
            'pronoun_object' => self::pronounObject($gender),
            'certification_date_display' => $date->format('j F Y'),
            'certification_date_short' => $date->format('n/j/Y'),
            'city' => $config['default_city'],
            'contact_line' => $config['contact_line'],
            'signatory_name' => $config['signatory']['name'],
            'signatory_title' => $config['signatory']['title'],
            'footer' => $config['footer'],
            'letterhead_logos' => $config['letterhead']['logos'],
        ];
    }

    public static function fromCertification(Certification $certification): array
    {
        return self::compose($certification);
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

    private static function confirmName(string $fullName, ?string $gender): string
    {
        $fullName = trim($fullName);
        if ($fullName === '') {
            return 'The registrant';
        }

        $honorific = match (strtolower((string) $gender)) {
            'female', 'f' => 'Ms.',
            'male', 'm' => 'Mr.',
            default => '',
        };

        $parts = preg_split('/\s+/', $fullName) ?: [];
        $familyName = $parts !== [] ? (string) end($parts) : $fullName;

        return trim($honorific.' '.$familyName);
    }

    private static function pronounSubject(?string $gender): string
    {
        return match (strtolower((string) $gender)) {
            'female', 'f' => 'She',
            'male', 'm' => 'He',
            default => 'The registrant',
        };
    }

    private static function pronounObject(?string $gender): string
    {
        return match (strtolower((string) $gender)) {
            'female', 'f' => 'her',
            'male', 'm' => 'him',
            default => 'them',
        };
    }
}
