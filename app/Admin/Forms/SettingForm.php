<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class SettingForm extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        admin_setting($input);
        return $this
				->response()
				->success('Processed successfully.')
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('web_name', trans('网站名称'))->default(admin_setting('web_name', '网站名'));
        $this->text('company_name', trans('公司名称'))->default(admin_setting('company_name', '公司名'));
        $this->text('url', trans('域名'))->default(admin_setting('url', ''));
        $this->text('version', trans('版本'))->default(admin_setting('version', '1.0.0'));
        $this->image('logo')->accept('jpg,png,gif,jpeg')->maxSize(1024)->autoUpload();
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
            'name'  => 'John Doe',
            'email' => 'John.Doe@gmail.com',
        ];
    }
}
