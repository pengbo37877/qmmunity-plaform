<?php

namespace App\Admin\Controllers;

use App\Models\Business;
use App\Models\Qkey;
use App\Admin\Selectable\Categories;
use App\Admin\Selectable\Qkeys;
use App\Admin\Selectable\Rates;
use App\Admin\Selectable\Users;
use App\Models\Area;
use App\Models\City;
use App\Models\Province;
use App\Models\Rate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BusinessController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Business';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Business());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->images()->image(env('APP_URL') . '/uploads', 64, 64);
        $grid->column('province.province', __('Province'));
        $grid->column('city.city', __('City'));
        $grid->column('area.area', __('Area'));
        $grid->column('address', __('Address'));
        $grid->column('working_time_from', __('Working time from'));
        $grid->column('working_time_to', __('Working time to'));
        $grid->column('price_title', __('Price title'));
        $grid->column('price_from', __('Price from'));
        $grid->column('price_to', __('Price to'));
        $grid->column('price_currency', __('Price currency'));
        // $grid->column('about', __('About'));
        $grid->column('recommend', __('Recommend'))->bool();
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Business::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        // $show->field('images', __('Images'));
        $show->images()->map(function ($path) {
            return env('APP_URL') . '/uploads/' . $path;
        })->image();

        $show->field('province.province', __('Province'));
        $show->field('city.city', __('City'));
        $show->field('area.area', __('Area'));
        $show->field('address', __('Address'));
        $show->field('working_time_from', __('Working time from'));
        $show->field('working_time_to', __('Working time to'));
        $show->field('price_title', __('Price title'));
        $show->field('price_from', __('Price from'));
        $show->field('price_to', __('Price to'));
        $show->field('price_currency', __('Price currency'));
        $show->field('about', __('About'));
        $show->field('recommend', __('Recommend'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->categories('Categories', function ($categories) {
            $categories->resource('/admin/categories');
            $categories->id();
            $categories->name();
            $categories->icon()->image(env('APP_URL') . '/uploads', 64, 64);
        });

        $show->qkeys('Q keys', function ($qkeys) {
            $qkeys->resource('/admin/qkeys');
            $qkeys->id();
            $qkeys->name();
            $qkeys->icon()->image(env('APP_URL') . '/uploads', 64, 64);
        });

        $show->savedUsers('Saved users', function ($users) {
            $users->resource('/admin/users');
            $users->id();
            $users->name();
        });

        $show->reviews('Reviews', function ($reviews) {
            $reviews->resource('/admin/reviews');
            $reviews->id();
            $reviews->message();
            $reviews->images()->image(env('APP_URL') . '/uploads', 64, 64);
        });

        $show->rates('Rate', function ($rates) {
            $rates->resource('/admin/rates');
            $rates->user_id();
            $rates->rating();
        });

        $show->ads('Ads', function ($reviews) {
            $reviews->resource('/admin/ads');
            $reviews->id();
            $reviews->image()->image(env('APP_URL') . '/uploads', 100, 64);
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Business());

        $form->text('name', __('Name'));
        $form->multipleImage('images', __('Images'))->removable()->uniqueName();
        $options = [
            "110000" => "北京市",
            "120000" => "天津市",
            "130000" => "河北省",
            "140000" => "山西省",
            "150000" => "内蒙古自治区",
            "210000" => "辽宁省",
            "220000" => "吉林省",
            "230000" => "黑龙江省",
            "310000" => "上海市",
            "320000" => "江苏省",
            "330000" => "浙江省",
            "340000" => "安徽省",
            "350000" => "福建省",
            "360000" => "江西省",
            "370000" => "山东省",
            "410000" => "河南省",
            "420000" => "湖北省",
            "430000" => "湖南省",
            "440000" => "广东省",
            "450000" => "广西壮族自治区",
            "460000" => "海南省",
            "500000" => "重庆市",
            "510000" => "四川省",
            "520000" => "贵州省",
            "530000" => "云南省",
            "540000" => "西藏自治区",
            "610000" => "陕西省",
            "620000" => "甘肃省",
            "630000" => "青海省",
            "640000" => "宁夏回族自治区",
            "650000" => "新疆维吾尔自治区",
            "710000" => "台湾省",
            "810000" => "香港特别行政区",
            "820000" => "澳门特别行政区",
        ];
        $form->select('provinceid', __('Province'))->options($options)->load('cityid', '/api/city');
        $form->select('cityid', __('City'))->options(function ($cityid) {
            $city = City::where('cityid', $cityid)->first();
            if ($city) {
                $cities = City::where('provinceid', $city->provinceid)->get();
                $options[$city->cityid] = $city->city;
                foreach ($cities as $c) {
                    if ($c->id != $city->id) {
                        $options[$c->cityid] = $c->city;
                    }
                }
                return $options;
            } else {
                return [];
            }
        })->load('areaid', '/api/area');
        $form->select('areaid', __('Area'))->options(function ($areaid) {
            $area = Area::where('areaid', $areaid)->first();
            if ($area) {
                $areas = Area::where('cityid', $area->cityid)->get();
                $options[$area->areaid] = $area->area;
                foreach ($areas as $a) {
                    $options[$a->areaid] = $a->area;
                }
                return $options;
            } else {
                return [];
            }
        });
        $form->text('address', __('Address'));
        $form->text('working_time_from', __('Working time from'));
        $form->text('working_time_to', __('Working time to'));
        $form->text('price_title', __('Price title'));
        $form->text('price_from', __('Price from'));
        $form->text('price_to', __('Price to'));
        $form->text('price_currency', __('Price currency'))->default('RMB');
        $form->textarea('about', __('About'));
        $form->radio('recommend', __('Recommend'))->options([1 => 'Recommend', 0 => 'Standard'])->default(0);

        $form->belongsToMany('categories', Categories::class, __('Categories'));
        // $form->multipleSelect('categories', 'Category')->options(Category::all()->pluck('name', 'id'));
        $form->belongsToMany('qkeys', Qkeys::class, __('Q keys'));
        // $form->multipleSelect('qkeys', 'Q keys')->options(Qkey::all()->pluck('name', 'id'));
        $form->belongsToMany('savedUsers', Users::class, __('Saved users'));

        $form->morphMany('reviews', function (Form\NestedForm $form) {
            $form->text('message');
            $form->multipleImage('images', __('Images'));
            $form->radio('show', __('Show'))->options([1 => 'Show', 0 => 'Hide'])->default(0);
        });

        $form->hasMany('ads', function (Form\NestedForm $form) {
            $form->image('image');
            $form->radio('show', __('Show'))->options([1 => 'Show', 0 => 'Hide'])->default(0);
        });


        return $form;
    }
}
