<?php

namespace App\Admin\Controllers;

use App\Models\UserProfile;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserProfileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserProfile';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserProfile());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('open_id', __('Open id'));
        $grid->column('union_id', __('Union id'));
        $grid->column('gender', __('Gender'));
        $grid->column('avatar', __('Avatar'))->image(48, 48);
        $grid->column('phone', __('Phone'));
        $grid->column('name', __('Name'));
        $grid->column('location', __('Location'));
        $grid->column('bio', __('Bio'));
        $grid->column('sexual_pref', __('Sexual pref'));
        $grid->column('gender_id', __('Gender id'));
        $grid->column('gender_exp', __('Gender exp'));
        $grid->column('romantically_attracted_to', __('Romantically attracted to'));
        $grid->column('interests', __('Interests'));
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
        $show = new Show(UserProfile::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('open_id', __('Open id'));
        $show->field('union_id', __('Union id'));
        $show->field('gender', __('Gender'));
        $show->field('avatar', __('Avatar'));
        $show->field('phone', __('Phone'));
        $show->field('name', __('Name'));
        $show->field('location', __('Location'));
        $show->field('bio', __('Bio'));
        $show->field('sexual_pref', __('Sexual pref'));
        $show->field('gender_id', __('Gender id'));
        $show->field('gender_exp', __('Gender exp'));
        $show->field('romantically_attracted_to', __('Romantically attracted to'));
        $show->field('interests', __('Interests'));
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
        $form = new Form(new UserProfile());

        $form->number('user_id', __('User id'));
        $form->text('open_id', __('Open id'));
        $form->text('union_id', __('Union id'));
        $form->text('gender', __('Gender'));
        $form->image('avatar', __('Avatar'));
        $form->mobile('phone', __('Phone'));
        $form->text('name', __('Name'));
        $form->text('location', __('Location'));
        $form->text('bio', __('Bio'));
        $form->text('sexual_pref', __('Sexual pref'));
        $form->text('gender_id', __('Gender id'));
        $form->text('gender_exp', __('Gender exp'));
        $form->text('romantically_attracted_to', __('Romantically attracted to'));
        $form->text('interests', __('Interests'));

        return $form;
    }
}
