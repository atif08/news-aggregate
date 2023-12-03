<?php

namespace Domain\Articles\Actions;

use App\Http\Integrations\Guardian\GuardianConnector;
use App\Http\Integrations\Guardian\Requests\SearchRequest;
use Carbon\Carbon;
use Domain\Articles\Enums\ArticleSource;
use Domain\Articles\Models\Article;

class StoreGuardianApiData
{

    public function execute($data): void
    {
        if (isset($data['response']['results']) && count($data['response']['results']) > 0) {

            foreach ($data['response']['results'] as $article) {

                $item = Article::updateOrCreate(["external_id" => $article['id']], [
                    "external_id" => $article['id'] ?? null,
                    "title" => $article['webTitle'] ?? null,
                    "excerpt" => $article['fields']['body'] ?? '',
                    "content" => $article['fields']['body'] ?? '',
                    "author" => $article['tags'][0]['webTitle'] ?? null,
                    "published_at" => Carbon::parse($article['webPublicationDate']),
                    "source" => ArticleSource::GUARDIAN,
                ]);

                if (!empty($article['fields']['thumbnail'])) {
                    $item
                        ->addMediaFromUrl($article['fields']['thumbnail'])
                        ->toMediaCollection();

                }
            }


        }
    }
}
