<?php

namespace App\Admin\Selectable;

use App\Models\Category;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class Categories extends Selectable
{
    public $model = Category::class;

    public function make()
    {
        $this->column('id');
        $this->column('name');
        $this->column('icon', 'Icon')->image(env('APP_URL') . '/uploads', 48, 48);
        $this->column('created_at');

        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}
