<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosting extends Model
{
    protected $fillable = [
        'admin_id',
        'employer_id',
        'job_title',
        'company',
        'location',
        'min_salary',
        'max_salary',
        'job_type',
        'job_description',
        'status',
    ];

    protected static function booted(): void
    {
        static::saving(function (JobPosting $job) {
            if ($job->employer_id) {
                $employer = $job->relationLoaded('employer')
                    ? $job->employer
                    : Employer::find($job->employer_id);

                if ($employer) {
                    $job->company = $employer->name;
                }
            }
        });
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }
}