<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function getIsAvailableAttribute(): bool
    {
        return $this->used_at == null;
    }
}
