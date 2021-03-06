<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function city()
    {
        $provinceid = request('q');
        $cities = City::select(['cityid', 'city'])->where('provinceid', $provinceid)->get();
        $options = [];
        foreach ($cities as $city) {
            array_push($options, [
                'id' => $city->cityid,
                'text' => $city->city
            ]);
        }
        return $options;
    }

    public function area()
    {
        $cityid = request('q');
        $areas = Area::select(['areaid', 'area'])->where('cityid', $cityid)->get();
        $options = [];
        foreach ($areas as $area) {
            array_push($options, [
                'id' => $area->areaid,
                'text' => $area->area
            ]);
        }
        return $options;
    }
}
