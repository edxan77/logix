<?php

namespace App\Services\Article;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

interface IArticleService
{
    public function add(array $data): Article;
    public function makeComment(array $data): Comment;
    public function likeResolver(int $articleId): void;
    public function search(array|null $searchData) : LengthAwarePaginator;
    public function getArticleById(int $id): Article;
}
