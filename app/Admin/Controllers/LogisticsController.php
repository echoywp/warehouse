<?php

namespace App\Admin\Controllers;

use App\Models\Logistics;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class LogisticsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Logistics(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('number');
            $grid->column('type');
            $grid->column('channel');
            $grid->column('destination');
            $grid->column('user_id');
            $grid->column('order_number');
            $grid->column('arrival_date');
            $grid->column('status');
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
        return Show::make($id, new Logistics(), function (Show $show) {
            $show->field('id');
            $show->field('number');
            $show->field('type');
            $show->field('channel');
            $show->field('destination');
            $show->field('user_id');
            $show->field('order_number');
            $show->field('arrival_date');
            $show->field('status');
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
        return Form::make(new Logistics(), function (Form $form) {
            $form->display('id');
            $form->text('number');
            $form->text('type');
            $form->text('channel');
            $form->text('destination');
            $form->text('user_id');
            $form->text('order_number');
            $form->text('arrival_date');
            $form->text('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
