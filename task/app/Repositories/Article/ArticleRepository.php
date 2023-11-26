<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\Comment;

class ArticleRepository implements IArticleRepository
{
    public function create(array $data): Article
    {
        $article = new Article($data);
        $article->save();

        return $article;
    }

    public function createComment(Article $article, array $data): Comment
    {
        $comment = new Comment($data);
        $article->comments()->save($comment);

        return $comment;
    }
}
