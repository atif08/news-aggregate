<?php

namespace Domain\Articles\Actions;

use App\Http\Integrations\Guardian\GuardianConnector;
use App\Http\Integrations\Guardian\Requests\SearchRequest;
use Carbon\Carbon;
use Domain\Articles\Enums\ArticleSource;
use Domain\Articles\Models\Article;

class GuardianApiFetcherAction
{
    private StoreGuardianApiData $storeGuardianApiData;

    public function __construct()
    {
        $this->storeGuardianApiData = new StoreGuardianApiData();
    }

    public function execute(): void
    {
        $page = 1;

        do {
            $connector = new GuardianConnector();
            $response = $connector->send(new SearchRequest($page));
            $data = $response->json();
            $this->storeGuardianApiData->execute($data);

            $page++;

        } while (isset($data['response']['results']) && count($data['response']['results']) > 0);
    }

}
