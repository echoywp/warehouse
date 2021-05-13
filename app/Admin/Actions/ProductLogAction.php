<?php

namespace App\Admin\Actions;

use App\Models\Product;
use App\Models\ProductLog;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Table;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductLogAction extends Action
{
    /**
     * @return string
     */
	protected $title = '日志';
    protected $modalId = 'show-current-log';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $id = $this->getKey();
        $gird =  Grid::make(new ProductLog(), function (Grid $grid) use ($id) {
            $grid->model()->orderBy('id', 'desc')->whereProductId($id)->with('user')->limit(6);
            $grid->column('user.name', trans('操作人'));
            $grid->column('content', trans('修改内容'))->display(function ($value) {
                return $value;
            });
            $grid->column('created_at');
            $grid->withBorder();
            $grid->disableToolbar();
            $grid->disableRowSelector();
            $grid->disablePagination();
            $grid->disableActions();
            $grid->addTableClass(['table-text-center']);
        });
        return $this->response()->html($gird);
    }

    protected function handleHtmlResponse()
    {
        return <<<'JS'
            function func(target, html, data) {
            var $modal = $(target.data('target'));

            $modal.find('.modal-body').html(html)
            $modal.modal('show')
        }
JS;

    }

    protected function setupHtmlAttributes()
    {
        // 添加class
        $this->addHtmlClass('btn btn-primary');

        // 保存弹窗的ID
        $this->setHtmlAttribute('data-target', '#'.$this->modalId);

        parent::setupHtmlAttributes();
    }

    public function html()
    {

        $html = parent::html();
        return <<<HTML
            {$html}
            <div class="modal fade" id="{$this->modalId}" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">{$this->title()}（最新6条）</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body"></div>
                </div>
              </div>
            </div>
HTML;
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        // return ['Confirm?', 'contents'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
