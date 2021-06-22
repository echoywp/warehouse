<?php
namespace App\Admin\Extensions\Form;

use Dcat\Admin\Admin;
use Dcat\Admin\Form\Field;

class ReviewIcon extends Field {

    public function render() {
        $show_status_image = reviewImg($this->column, $this->value);
        if ($show_status_image) {
            Admin::style($this->style());
            return "<i data-column='{$this->column}' data-value='{$this->value}' class='post-img'><img src='{$show_status_image}' /></i>";
        }
    }

    protected function style() {
        return <<<'CSS'
            .post-img {
                position: absolute;
                right: -180px;
                top: -3rem;
                width: 160px;
                height: 100px;
                z-index: 999;
            }
            .post-img img {
                width: 100%;
            }
CSS;
    }

    protected function img($value) {

    }

}
