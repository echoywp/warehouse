<?php

namespace App\Admin\Actions;

use App\Models\Product;
use App\Models\ProductLog;
use App\services\ProductCardService;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Table;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateProductCardAction extends Action
{
    /**
     * @return string
     */
	protected $title = '货架卡';
    protected $modalId = 'show-current-card';

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
        $path = '/productCard/'. $id . '.jpg';
//        if(file_exists($path)) {
            $product = Product::find($id);
            app(ProductCardService::class)->createCard($product);
//        }
        return $this->response()->html('<img src="'. $path .'">');
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
                    <h4 class="modal-title">{$this->title()}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body" style="text-align: center"></div>
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
