<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password'));
        $grid->column('two_factor_secret', __('Two factor secret'));
        $grid->column('two_factor_recovery_codes', __('Two factor recovery codes'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('current_team_id', __('Current team id'));
        $grid->column('profile_photo_path', __('Profile photo path'))->image(48, 48);
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('two_factor_secret', __('Two factor secret'));
        $show->field('two_factor_recovery_codes', __('Two factor recovery codes'));
        $show->field('remember_token', __('Remember token'));
        $show->field('current_team_id', __('Current team id'));
        $show->field('profile_photo_path', __('Profile photo path'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->textarea('two_factor_secret', __('Two factor secret'));
        $form->textarea('two_factor_recovery_codes', __('Two factor recovery codes'));
        $form->text('remember_token', __('Remember token'));
        $form->number('current_team_id', __('Current team id'));
        $form->textarea('profile_photo_path', __('Profile photo path'));

        return $form;
    }
}
