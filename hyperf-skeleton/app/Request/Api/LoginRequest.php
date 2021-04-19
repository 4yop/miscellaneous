<?php

declare(strict_types=1);

namespace App\Request\Api;



use Hyperf\Validation\Rule;

class LoginRequest extends ApiRequest
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
        $username = $this->username;
        return [
            'username' => [
                'required',
                'max:16',
//                Rule::exists('member')->where(function ($query) use ($username) {
//                    $query->where('username', $username);
//                }),
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
