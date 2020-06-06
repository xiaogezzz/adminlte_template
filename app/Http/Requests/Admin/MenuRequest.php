<?php

namespace App\Http\Requests\Admin;

class MenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('menu')->id ?? '';
        return [
            'parent_id' => 'required',
            'title' => 'required|unique:admin_menus,title,' . $id,
        ];
    }
}
