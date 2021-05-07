<?php

declare(strict_types=1);

namespace App\Request;



use Hyperf\Validation\Rule;

class RegisterRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $username = $this->input('username');
        return [
            'username' => [
                'required',
                'max:16',
            ],
            'password' => 'required',
        ];

    }

    /**
     * 获取验证错误的自定义属性
     */
    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }
}
