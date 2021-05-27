<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * 重置返回格式
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        $error = $validator->errors()->all();
        throw new HttpResponseException(responseJson(501, $error[0], 'danger'));
    }
}
