<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    protected $fillable = [
        'applicant_id',
        'job_posting_id',
        'admin_id',
        'employer_id',
        'fullname',
        'job_title',
        'employer',
        'status',
    ];

    protected static function booted(): void
    {
        static::saving(function (Referral $referral) {
            if ($referral->employer_id) {
                $employer = $referral->relationLoaded('employer')
                    ? $referral->employer
                    : Employer::find($referral->employer_id);

                if ($employer) {
                    $referral->employer = $employer->name;
                }
            }
        });
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function jobPosting(): BelongsTo
    {
        return $this->belongsTo(JobPosting::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function employerRecord(): BelongsTo
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }
}
