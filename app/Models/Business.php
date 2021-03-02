<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'images', 'address', 'working_time_from', 'working_time_to',
        'price_from', 'price_to', 'price_currency', 'about'
    ];

    public function setImagesAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['images'] = json_encode($pictures);
        }
    }

    public function getImagesAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'business_category', 'business_id', 'category_id');
    }

    public function qkeys()
    {
        return $this->belongsToMany(Qkey::class, 'business_qkey', 'business_id', 'qkey_id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
