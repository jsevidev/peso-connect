<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certification extends Model
{
    protected $fillable = [
        'applicant_id',
        'admin_id',
        'fullname',
        'barangay',
        'id_type',
        'id_document_path',
        'date_requested',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_requested' => 'date',
        ];
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
