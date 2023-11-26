<?php

namespace App\Http\Requests;

class UserImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'image' => 'required|file|mimes:jpeg,png,svg,pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => self::REQUIRED_MESSAGE,
            'image.*' => self::INVALID_TYPE_MESSAGE,
        ];
    }
}
