<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon'];

    public function parent()
    {
        return $this->belongsToMany(Category::class, 'category_relation', 'child_id', 'parent_id');
    }

    public function children()
    {
        return $this->belongsToMany(Category::class, 'category_relation', 'parent_id', 'child_id');
    }

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_category', 'category_id', 'business_id');
    }
}
