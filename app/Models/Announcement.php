<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    protected $fillable = [
        'admin_id',
        'slug',
        'title',
        'description',
        'category',
        'status',
        'publish_date',
        'scheduled_date',
        'scheduled_time',
        'author_name',
    ];

    protected function casts(): array
    {
        return [
            'publish_date' => 'date',
            'scheduled_date' => 'date',
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
