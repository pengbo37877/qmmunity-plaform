<?php

namespace App\Admin\Controllers;

use App\Models\Business;
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
        $grid->column('images', __('Images'))->display(function ($images) {
            return $images;
        })->image(env('APP_URL') . '/uploads', 100, 100);;
        $grid->column('address', __('Address'));
        $grid->column('working_time_from', __('Working time from'));
        $grid->column('working_time_to', __('Working time to'));
        $grid->column('price_from', __('Price from'));
        $grid->column('price_to', __('Price to'));
        $grid->column('price_currency', __('Price currency'));
        $grid->column('about', __('About'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show->images()->unescape()->as(function ($images) {
            $imgs = json_decode($images, true);
            return array_map(function ($img) {
                return "<img src='/uploads/{$img}' />";
            }, $imgs);
        });

        $show->field('address', __('Address'));
        $show->field('working_time_from', __('Working time from'));
        $show->field('working_time_to', __('Working time to'));
        $show->field('price_from', __('Price from'));
        $show->field('price_to', __('Price to'));
        $show->field('price_currency', __('Price currency'));
        $show->field('about', __('About'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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
        $form->text('price_from', __('Price from'));
        $form->text('price_to', __('Price to'));
        $form->text('price_currency', __('Price currency'))->default('RMB');
        $form->textarea('about', __('About'));

        return $form;
    }
}
