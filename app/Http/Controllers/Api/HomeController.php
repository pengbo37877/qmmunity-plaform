<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Http\Resources\BusinessResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\NoticeResource;
use App\Models\Ad;
use App\Models\Business;
use App\Models\Category;
use App\Models\Notice;
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
        $businesses = Business::recommend()->order()->get();
        return BusinessResource::collection($businesses);
    }

    public function ads()
    {
        $ads = Ad::show()->order()->get();
        return AdResource::collection($ads);
    }

    public function notice()
    {
        $notice = Notice::show()->first();
        return new NoticeResource($notice);
    }

    public function search()
    {
        $q = request('q');
        $city = request('city');
        // 搜索business
        $businesses = Business::where('name', 'like', '%' . $q . '%')->get();
        return BusinessResource::collection($businesses);
    }
}
