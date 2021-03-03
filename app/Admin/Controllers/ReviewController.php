<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User Id'));
        $grid->column('message', __('Message'));
        $grid->images()->map(function ($path) {
            return env('APP_URL') . '/uploads/' . $path;
        })->image();
        $grid->column('show', __('Show'))->bool();
        $grid->column('reviewable_id', __('Reviewable id'));
        $grid->column('reviewable_type', __('Reviewable type'));
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
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User Id'));
        $show->field('message', __('Message'));
        $show->images()->map(function ($path) {
            return env('APP_URL') . '/uploads/' . $path;
        })->image();
        $show->show()->using([1 => 'Show', 0 => 'Hide']);
        $show->field('reviewable_id', __('Reviewable id'));
        $show->field('reviewable_type', __('Reviewable type'));
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
        $form = new Form(new Review());

        $form->number('user_id', __('User Id'));
        $form->textarea('message', __('Message'));
        $form->multipleImage('images', __('Images'))->removable()->uniqueName();
        $form->radio('show', __('Show'))->options([1 => 'Show', 0 => 'Hide'])->default(1);
        $form->number('reviewable_id', __('Reviewable id'));
        $form->text('reviewable_type', __('Reviewable type'));

        return $form;
    }
}
