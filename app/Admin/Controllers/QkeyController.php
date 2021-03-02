<?php

namespace App\Admin\Controllers;

use App\Models\Qkey;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QkeyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Qkey';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Qkey());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('icon', __('Icon'))->image(env('APP_URL') . '/uploads', 64, 64);
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
        $show = new Show(Qkey::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        // $show->field('icon', __('Icon'));
        $show->icon()->unescape()->as(function ($icon) {
            return "<img src='/uploads/{$icon}'/>";
        });
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
        $form = new Form(new Qkey());

        $form->text('name', __('Name'));
        $form->image('icon', __('Icon'))->thumbnail('small', $width = 300, $height = 300)->uniqueName();

        return $form;
    }
}
