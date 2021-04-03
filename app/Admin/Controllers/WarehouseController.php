<?php

namespace App\Admin\Controllers;

use App\Models\Warehouse;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class WarehouseController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Warehouse(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('address');
            $grid->column('mobile');
            $grid->column('contact_person');
            $grid->column('area');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Warehouse(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('address');
            $show->field('mobile');
            $show->field('contact_person');
            $show->field('area');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Warehouse(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('address');
            $form->text('mobile');
            $form->text('contact_person');
            $form->text('area');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
