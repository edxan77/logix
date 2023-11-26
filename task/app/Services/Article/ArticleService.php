<?php

namespace App\Services\Article;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Repositories\Article\IArticleRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ArticleService implements IArticleService
{
    public function __construct(
        private IArticleRepository $articleRepository
    )
    {
    }

    public function add(array $data): Article
    {
        $data['user_id'] = Auth::id() ?? null;
        return $this->articleRepository->create($data);
    }

    public function makeComment(array $data): Comment
    {
        $data['user_id'] = Auth::id();

        $article = $this->getArticleById($data['article_id']);

        return $this->articleRepository->createComment($article, $data);
    }

    public function search(array|null $searchData): LengthAwarePaginator
    {
        $searchQuery = Article::with('comments', 'likes');

        if ($searchData != null) {
            if ($searchData['title'] != null) {
                $searchQuery->where('title', 'like', "%{$searchData['title']}%");
            }

            if ($searchData['description'] != null) {
                $searchQuery->where('description', 'like', "%{$searchData['description']}%");
            }

            if ($searchData['tags'] != null) {
                $searchQuery->where('tags', 'like', "%{$searchData['tags']}%");
            }
        }

        return $searchQuery->paginate(2);
    }

    public function getArticleById(int $id): Article
    {
        return Article::where('id', $id)->withCount('likes')->first();
    }

    public function likeResolver(int $articleId): void
    {
        $userArticleLike = Like::where('article_id', $articleId)->where('user_id', Auth::id());

        if (!$userArticleLike->first()) {
            Like::create([
                'user_id' => Auth::id(),
                'article_id' => $articleId
            ]);
        } else {
            $userArticleLike->delete();
        }
    }
}
