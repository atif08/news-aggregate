<?php

namespace Domain\Articles\Actions;

use App\Http\Integrations\News\NewsConnector;
use App\Http\Integrations\News\Requests\ArticlesRequest;
use Carbon\Carbon;
use Domain\Articles\Enums\ArticleSource;
use Domain\Articles\Models\Article;

class StoreNewsApiData
{

    public function execute($data): void
    {

        if (isset($data['articles']) && count($data['articles']) > 0) {

            foreach ($data['articles'] as $article) {

                $item = Article::updateOrCreate(["title" => $article['title']],
                    [
                        "title" => $article['title'] ?? null,
                        "excerpt" => $article['content'] ?? null,
                        "content" => $article['description'] ?? null,
                        "author" => $article['author'] ?? null,
                        "published_at" => Carbon::parse($article['publishedAt']),
                        "source" => ArticleSource::NEWS,
                    ]);

                if (!empty($article['urlToImage'])) {
                    $item
                        ->addMediaFromUrl($article['urlToImage'])
                        ->toMediaCollection();

                }

            }

        }

    }
}
