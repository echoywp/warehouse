<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Product;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Http\JsonResponse;

class CategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Category(), function (Grid $grid) {
            $grid->column('id')->tree();
            $grid->column('title');
            $grid->column('updated_at')->sortable();
            $grid->disableFilter();
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
        return Show::make($id, new Category(), function (Show $show) {
            $show->field('id');
            $show->field('parent_id');
            $show->field('title');
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
        return Form::make(new Category(), function (Form $form) {
            $form->select('parent_id')->options(Category::selector())->required();
            $form->text('title')->required();
        });
    }

    public function destroy($id)
    {
        $hasChild = Category::whereParentId($id)->first();
        if($hasChild) {
            return response()->json(['status' => true, 'data' => [
                'type' => 'warning',
                'message' => '此分类下还有下级分类，暂不可删除！'
            ]]);
        }

        $hasProduct = Product::whereCategoryId($id)->first();

        if ($hasProduct) {
            return response()->json(['status' => true, 'data' => [
                'type' => 'warning',
                'message' => '此分类下还有相关产品，暂不可删除！'
            ]]);
        }
        return parent::destroy($id);
    }
}
