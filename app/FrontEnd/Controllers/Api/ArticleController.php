<?php

namespace App\FrontEnd\Controllers\Api;

use App\FrontEnd\Controllers\Queries\ArticleIndexQuery;
use App\Http\Controllers\Controller;
use App\Jobs\FetchGuardianJob;
use App\Jobs\FetchNewsJob;
use App\Jobs\FetchNewYorkTimeJob;
use Domain\Articles\Models\Article;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __invoke(ArticleIndexQuery $articleIndexQuery): JsonResponse
    {
//        $articles = $articleIndexQuery->paginate();
//        return response()->json($articles);
        dispatch(new FetchNewsJob());
        dispatch(new FetchNewYorkTimeJob());
        dispatch(new FetchGuardianJob());

    }
}
