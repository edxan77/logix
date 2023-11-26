<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\Comment;

interface IArticleRepository
{
    public function create(array $data): Article;
    public function createComment(Article $article, array $data): Comment;
}
