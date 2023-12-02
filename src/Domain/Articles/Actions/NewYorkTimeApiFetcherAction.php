<?php

namespace Domain\Articles\Actions;

use App\Http\Integrations\NewYorkTime\NewYorkTimeConnector;
use App\Http\Integrations\NewYorkTime\Requests\ArticleSearchRequest;
use Carbon\Carbon;
use Domain\Articles\Enums\ArticleSource;
use Domain\Articles\Models\Article;

class NewYorkTimeApiFetcherAction
{
    private StoreNewYorkTimeApiData $storeNewsApiData;

    public function __construct()
    {
        $this->storeNewsApiData = new StoreNewYorkTimeApiData();
    }

    public function execute(): void
    {
        $connector = new NewYorkTimeConnector();
        $response = $connector->send(new ArticleSearchRequest());
        $this->storeNewsApiData->execute($response->json());
    }

}
