<?php

namespace App\Admin\Controllers;

use App\Models\Business;
use App\Models\Qkey;
use App\Admin\Selectable\Categories;
use App\Admin\Selectable\Qkeys;
use App\Admin\Selectable\Rates;
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
        $grid->column('address', __('Address'));
        $grid->column('working_time_from', __('Working time from'));
        $grid->column('working_time_to', __('Working time to'));
        $grid->column('price_title', __('Price title'));
        $grid->column('price_from', __('Price from'));
        $grid->column('price_to', __('Price to'));
        $grid->column('price_currency', __('Price currency'));
        $grid->column('about', __('About'));
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
