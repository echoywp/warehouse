<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Product;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class ProductController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Product(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('desc');
            $grid->column('category_id');
            $grid->column('unit');
            $grid->column('length');
            $grid->column('width');
            $grid->column('height');
            $grid->column('weight');
            $grid->column('price');
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
        return Show::make($id, new Product(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('desc');
            $show->field('category_id');
            $show->field('unit');
            $show->field('length');
            $show->field('width');
            $show->field('height');
            $show->field('weight');
            $show->field('price');
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
        return Form::make(new Product(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('desc')->required();
            $form->text('category_id')->required();
            $form->text('unit')->required();
            $form->text('length')->required();
            $form->text('width')->required();
            $form->text('height')->required();
            $form->text('weight')->required();
            $form->text('price')->required();
            $form->text('status')->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
