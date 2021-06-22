<?php

namespace App\Admin\Controllers;

use App\Models\Supplier;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class SupplierController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Supplier(), function (Grid $grid) {
            $grid->column('name');
            $grid->column('contract_person');
            $grid->column('mobile');
            $grid->column('address');
            $grid->column('status')->switch();
            $grid->column('settlement')->using(Supplier::$settlement)->label(Supplier::$settlement_color);
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name');
            });
        });
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Supplier(), function (Form $form) {
            $form->text('name')->required();
            $form->text('contract_person')->required();
            $form->text('mobile')->required();
            $form->text('address')->required();
            $form->radio('settlement')->options(Supplier::$settlement)->default(1);
            $form->hidden('status')->default(1);
        });
    }
}
