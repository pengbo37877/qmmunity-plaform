<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qkey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon'];

    public function businesses()
    {
        return $this->belongsToMany(Qkey::class, 'business_qkey', 'qkey_id', 'business_id');
    }
}
