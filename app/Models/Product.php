<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getIsAvailableAttribute(): bool
    {
        return $this->pieces_in_stock > 0;
    }

    public function scopeAvailable($query): Builder
    {
        return $query->where('pieces_in_stock', '>', 0);
    }
}
