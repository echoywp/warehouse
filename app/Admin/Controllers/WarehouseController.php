<?php

namespace App\Admin\Controllers;

use App\Models\Warehouse;
use App\Rules\Mobile;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class WarehouseController extends AdminController
{
    protected $filename = '仓库信息';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Warehouse(), function (Grid $grid) {
            $grid->column('name');
            $grid->column('address');
            $grid->column('mobile');
            $grid->column('contact_person');
            $grid->column('area');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });

            $grid->export()->filename($this->filename);
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
            $form->text('name')->required()->rules('max:30', config('option.rules'));
            $form->text('address')->required()->rules('max:50', config('option.rules'));
            $form->text('mobile')->required()->rules(['numeric', new Mobile()], config('option.rules'));
            $form->text('contact_person')->required()->rules('max:10', config('option.rules'));
            $form->text('area')->required()->rules('numeric', config('option.rules'));
        });
    }
}
