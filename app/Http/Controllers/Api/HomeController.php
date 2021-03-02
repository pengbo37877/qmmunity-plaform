<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessResource;
use App\Http\Resources\CategoryResource;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function categories()
    {
        $categories = Category::home()->get();
        return CategoryResource::collection($categories);
    }

    public function businesses()
    {
        $businesses = Business::home()->get();
        return BusinessResource::collection($businesses);
    }
}
