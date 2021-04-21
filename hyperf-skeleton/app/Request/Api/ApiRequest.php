<?php


namespace App\Request\Api;


use App\Exception\ParameterException;
use Hyperf\Contract\ValidatorInterface;
use Hyperf\Validation\Request\FormRequest;

class ApiRequest extends FormRequest
{
    public function failedValidation(ValidatorInterface $validator)
    {
        throw new ParameterException($validator->errors()->first(),500);
    }
}