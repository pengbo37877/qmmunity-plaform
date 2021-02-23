<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'location', 'bio', 'sexual_pref',
        'gender_id', 'gender_exp', 'romantically_attracted_to',
        'interests', 'open_id', 'union_id', 'gender', 'avatar',
        'phone'
    ];
}
