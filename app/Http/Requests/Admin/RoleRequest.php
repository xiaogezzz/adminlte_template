<?php

namespace App\Http\Requests\Admin;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('role') ? $this->route('role')->id : '';

        return [
            'name' => 'required|alpha_dash|unique:admin_roles,name,' . $id,
            'display_name' => 'required|unique:admin_roles,display_name,' . $id,
            'permission' => 'array',
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
