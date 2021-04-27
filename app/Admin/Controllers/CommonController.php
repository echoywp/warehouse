<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\SettingForm;
use App\Models\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;

class CommonController extends AdminController
{
    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('系统配置'))
            ->body(new Card(new SettingForm()));
    }
}
