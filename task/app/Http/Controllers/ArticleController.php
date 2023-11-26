<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\Article\IArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct(
        private IArticleService $articleService
    ){}

    public function index()
    {
        return view('article.index');
    }

    public function all(Request $request)
    {
        $articles = $this->articleService->search($request->f);

        return view('article.all')->with([
            'articles' => $articles,
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        $data['image'] = base64_encode(file_get_contents($request->file('image')->path()));

        $this->articleService->add($data);

        return redirect('/articles');
    }

    public function addComment(Request $request)
    {
        $userFullName = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        return response()->json([
            'status' => 'OK',
            'data' => [
                'article' => $this->articleService->makeComment($request->all()),
                'author' => $userFullName
            ]
        ]);
    }

    public function like(Request $request)
    {
        $this->articleService->likeResolver($request->id);

        return response()->json([
            'status' => 'OK',
            'data' => $this->articleService->getArticleById($request->id)
        ]);
    }
}
