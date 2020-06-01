<?php

namespace App\Http\Requests\Admin;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('permission') ? $this->route('permission')->id : '';

        return [
            'name' => 'required|unique:admin_roles,name,' . $id,
            'display_name' => 'required|unique:admin_roles,display_name,' . $id,
        ];
    }

    public function attributes()
    {
        return [
            'name' => '标识',
            'display_name' => '名称',
        ];
    }
}
