<?php
namespace App\Http\Requests;

use App\Models\Inventory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductRequest extends Request
{

    public function rules()
    {
        return [
            'id' => 'required|exists:product,id|exists:inventory,product_id',
            'type' => ['required', Rule::in([2, 3]),],
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function($attribute, $value, $fail) {
                    $inventory = Inventory::whereProductId($this->id)->first();
                    if ($inventory && $this->type == 3 && $inventory->available_inventory < $value) {
                        $fail('库存数量不足');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'id.required' => '请求错误',
            'id.exists' => '产品/库存不存在',
            'type.required' => '请求错误',
            'type.in' => '请求类型错误',
            'quantity.required' => '操作数量不能为空',
            'quantity.integer' => '操作数量必须是数字',
            'quantity.min' => '操作数量不能小于1',
        ];
    }
}
