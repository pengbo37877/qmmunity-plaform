<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('icon', __('Icon'))->image(env('APP_URL') . '/uploads', 64, 64);
        $grid->column('show_in_home', __('Show in home'))->bool();
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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        // $show->field('icon', __('Icon'));
        $show->icon()->unescape()->as(function ($icon) {
            return "<img src='/uploads/{$icon}'/>";
        });
        $show->show_in_home()->using([1 => 'Show', 0 => 'Hide']);
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->children('Category children', function ($categories) {
            $categories->resource('/admin/categories');
            $categories->id();
            $categories->name();
            $categories->icon()->image();
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
        $form = new Form(new Category());

        $form->text('name', __('Name'));
        $form->image('icon', __('Icon'))->thumbnail('small', $width = 300, $height = 300)->uniqueName();
        $form->radio('show_in_home', __('Show in home'))->options([1 => 'Show', 0 => 'Hide'])->default(0);
        return $form;
    }
}
