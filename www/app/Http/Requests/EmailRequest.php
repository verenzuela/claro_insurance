<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'direction' => 'in:asc,desc',
            'sort' => 'in:from,created_at',
            'filter_text' => 'string',
            'items' => 'numeric'
        ];
    }

    public function attributes(): array
    {
        return [
            'direction' => __('labels.direction'),
            'direction' => __('labels.sort'),
        ];
    }

    public function messages()
    {
        return [
            'direction.in' => __('validation.direction.in'),
            'sort.in' => __('validation.sort.in')
        ];
    }

    protected function failedValidation(Validator $validator)
    {   
        throw new HttpResponseException(
            response()->json(['data' => $validator->errors()], 422)
        );
    }
}
