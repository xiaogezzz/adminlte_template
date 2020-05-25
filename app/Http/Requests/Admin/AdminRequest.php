<?php

namespace App\Http\Requests\Admin;

class AdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                $rules['name'] = 'required|alpha_dash|unique:admins,name';
                $rules['password'] = 'required|min:6';
                break;
            case 'PUT':
                $rules['name'] = 'required|alpha_dash';
        }

        $rules['roles'] = 'required|array';
        $rules['nickname'] = 'required';
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '请填写用户名',
            'name.alpha_num' => '用户名只能包含字母和数字',
            'name.unique' => '该用户名已存在',
            'nickname.required' => '请填写昵称',
            'password.required' => '请填写密码',
            'password.min' => '密码至少6个字符',
            'roles.required' => '请选择用户角色',
            'roles.array' => '用户角色格式有误',
        ];
    }
}
