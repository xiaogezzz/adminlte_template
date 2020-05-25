<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FormRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpException(422, $validator->errors()->first());
    }
}
