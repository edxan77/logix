<?php

namespace App\Http\Requests;

use App\Models\Article;

class ArticleRequest extends Request
{
    public function rules(): array
    {
        return [
            'image' => 'required|file|mimes:jpeg,png,svg,pdf|max:2048',
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:' . Article::TYPE_BLOG . ',' . Article::TYPE_NEWS,
            'tags' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => self::REQUIRED_MESSAGE,
            'image.*' => self::INVALID_TYPE_MESSAGE,
            'title.required' => self::REQUIRED_MESSAGE,
            'title.*' => self::INVALID_TYPE_MESSAGE,
            'description.required' => self::REQUIRED_MESSAGE,
            'description.*' => self::INVALID_TYPE_MESSAGE,
            'type.required' => self::REQUIRED_MESSAGE,
            'type.*' => self::INVALID_TYPE_MESSAGE,
            'tags.*' => self::INVALID_TYPE_MESSAGE,
        ];
    }
}
