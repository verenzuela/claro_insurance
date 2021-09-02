<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|regex:/[a-zA-Z0-9]*[@$!%*#?&.]/',
            'name' => 'required|string|max:100',
            'phone_number' => 'nullable|string|min:8|max:10',
            'num_docm_identity' => 'required|string|max:11',
            'city_id' => 'required|exists:cities,id',
            'date_of_birth' => 'required|date|olderThan'
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => __('labels.email'),
            'password' => __('labels.password'),
            'name' => __('labels.name'),
            'phone_number' => __('labels.phone_number'),
            'num_docm_identity' => __('labels.num_docm_identity'),
            'city_id' => __('labels.city_id'),
            'date_of_birth' => __('labels.date_of_birth')
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => __('validation.password_conditions'),
            'date_of_birth.olderThan' => __('validation.olderThan')
        ];
    }
    
}
