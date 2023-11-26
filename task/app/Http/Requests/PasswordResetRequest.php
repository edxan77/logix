<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasswordResetRequest extends Request
{
    public function rules(): array
    {
        return [
            'token' => 'string',
            'password' => 'required|string|min:6|max:100|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => self::REQUIRED_MESSAGE,
            'password.*' => self::INVALID_TYPE_MESSAGE,
            'password_confirmation.required' => self::REQUIRED_MESSAGE,
            'password_confirmation.*' => self::INVALID_CONFIRMATION_MESSAGE,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = [];

        foreach ($validator->errors()->getMessages() as $key => $error) {
            $errors[$key] =  $error[0];
        }

        throw new HttpResponseException(response()->json([
            'status' => 'INVALID_DATA',
            'errors' => $errors
        ], 200));
    }

}
