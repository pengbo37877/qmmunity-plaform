<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'show'];

    public function scopeShow($query)
    {
        return $query->where('show', 1);
    }
}
