<?php

namespace App\Admin\Controllers;

use App\Models\QConfig;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QConfigController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QConfig';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QConfig());

        $grid->column('id', __('Id'));
        $grid->column('key', __('Key'));
        $grid->column('value', __('Value'));

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
        $show = new Show(QConfig::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('key', __('Key'));
        $show->field('value', __('Value'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QConfig());
        $form->text('key', __('Key'));
        $form->text('value', __('Value'));


        return $form;
    }
}
