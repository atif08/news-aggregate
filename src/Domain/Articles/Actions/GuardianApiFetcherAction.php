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
        $connector = new GuardianConnector();
        $response = $connector->send(new SearchRequest());
        $this->storeGuardianApiData->execute($response->json());
    }

}
