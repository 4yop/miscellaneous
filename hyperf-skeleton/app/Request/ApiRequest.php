<?php

declare(strict_types=1);

namespace App\Request;

use App\Exception\InvalidException;
use Hyperf\Contract\ValidatorInterface;
use Hyperf\Validation\Request\FormRequest;



class ApiRequest extends FormRequest
{
    protected function failedValidation(ValidatorInterface $validator)
    {
        throw new InvalidException($validator->errors()->first());
    }
}
