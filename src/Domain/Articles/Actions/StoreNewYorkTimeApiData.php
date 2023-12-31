<?php

namespace Domain\Articles\Actions;

use App\Http\Integrations\NewYorkTime\NewYorkTimeConnector;
use App\Http\Integrations\NewYorkTime\Requests\ArticleSearchRequest;
use Carbon\Carbon;
use Domain\Articles\Enums\ArticleSource;
use Domain\Articles\Models\Article;

class StoreNewYorkTimeApiData
{

    public function execute($data): void
    {

        if (isset($data['response']['docs']) && count($data['response']['docs']) > 0) {

            foreach ($data['response']['docs'] as $article) {

                Article::updateOrCreate(["external_id" => $article['_id']], [
                    "external_id" => $article['_id'] ?? null,
                    "title" => $article['headline']['main'] ?? null,
                    "excerpt" => $article['abstract'] ?? null,
                    "content" => $article['lead_paragraph'] ?? null,
                    "author" => $article['byline']['original'] ?? null,
                    "published_at" => Carbon::parse($article['pub_date']),
                    "source" => ArticleSource::NEW_YORK_TIME,
                ]);
            }
        }

    }
}
