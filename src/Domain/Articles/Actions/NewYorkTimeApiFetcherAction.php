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

        $page = 1;

        do {
            $connector = new NewYorkTimeConnector();
            $response = $connector->send(new ArticleSearchRequest($page));
            $data = $response->json();
            $this->storeNewsApiData->execute($data);

            $page++;

        } while (isset($data['response']['docs']) && count($data['response']['docs']) > 0);
    }

}
