<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailResetRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users|max:255',
            'code' => 'required|numeric|digits:4',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => self::REQUIRED_MESSAGE,
            'email.unique' => self::UNIQUE_MESSAGE,
            'email.*' => self::INVALID_TYPE_MESSAGE,
            'code.required' => self::REQUIRED_MESSAGE,
            'code.*' => self::INVALID_TYPE_MESSAGE,
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
