<?php

namespace App\Admin\Selectable;

use App\Models\User;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class Users extends Selectable
{
    public $model = User::class;

    public function make()
    {
        $this->column('id');
        $this->column('name');
        $this->column('created_at');

        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}
