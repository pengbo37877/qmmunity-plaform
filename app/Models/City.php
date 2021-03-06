<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['cityid', 'city', 'provinceid'];

    public function areas()
    {
        return $this->hasMany(Area::class, 'cityid', 'areaid');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'cityid', 'provinceid');
    }
}
