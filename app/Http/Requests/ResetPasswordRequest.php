<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required',
            'token' => ['required', 'exists:password_reset_tokens,token']
        ];
    }
    public function failedValidation(Validator $validator)
     {
            throw  new HttpResponseException(final_response(status: 401,message: __('custom.credentials_errors'),errors: $validator->errors()->first()));
     }// end of failedValidation function
}
