<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model
{
    protected $fillable = [
        'name',
        'abbr',
        'peso_verified',
        'contact_person',
        'contact_email',
        'address',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'peso_verified' => 'boolean',
        ];
    }

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }

    public static function normalizeName(string $name): string
    {
        return trim(preg_replace('/\s*\((PESO Verified|PESO Partner)\)\s*/i', '', $name) ?? $name);
    }

    public static function makeAbbr(string $name): string
    {
        $clean = self::normalizeName($name);
        $words = preg_split('/\s+/', $clean) ?: [];
        $abbr = '';

        foreach (array_slice($words, 0, 3) as $word) {
            $abbr .= strtoupper(mb_substr($word, 0, 1));
        }

        return $abbr !== '' ? $abbr : 'EMP';
    }

    public static function detectPesoVerified(string $name): bool
    {
        return (bool) preg_match('/(PESO Verified|PESO Partner)/i', $name);
    }
}
