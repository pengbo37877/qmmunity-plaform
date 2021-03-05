<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'message', 'images', 'show', 'reviewable_id', 'reviewable_type',
        'likes_count'
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

    public function scopeShow($query)
    {
        return $query->where('show', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'user_like_review', 'review_id', 'user_id');
    }
}
