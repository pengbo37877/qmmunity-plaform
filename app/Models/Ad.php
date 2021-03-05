<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'business_id', 'show'];

    public function scopeShow($query)
    {
        return $query->where('show', true);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
