<?php

namespace App\Admin\Controllers;

use App\Models\Ad;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Ad';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Ad());

        $grid->column('id', __('Id'));
        $grid->column('image', __('Image'))->image(env('APP_URL') . '/uploads/', 100, 64);;
        $grid->column('business_id', __('Business id'));
        $grid->column('business.name', __('Business name'));
        $grid->column('show', __('Ad Show'))->bool();
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
        $show = new Show(Ad::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('business_id', __('Business id'));
        $show->field('show', __('Show'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->business('Business Info', function ($business) {

            $business->setResource('/admin/businesses');

            $business->id();
            $business->name();
            $business->images()->image(env('APP_URL') . '/uploads/', 100, 100);
            $business->address();
            $business->working_time_from();
            $business->working_time_to();
            $business->price_title();
            $business->price_from();
            $business->price_to();
            $business->price_currency();
            $business->recommend();
            $business->about();
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
        $form = new Form(new Ad());

        $form->image('image', __('Image'));
        $form->text('business_id', __('Business id'));
        $form->switch('show', __('Show'))->default(1);

        return $form;
    }
}
