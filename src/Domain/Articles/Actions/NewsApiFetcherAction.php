<?php

namespace Domain\Articles\Actions;

use App\Http\Integrations\News\NewsConnector;
use App\Http\Integrations\News\Requests\ArticlesRequest;
use Carbon\Carbon;
use Domain\Articles\Enums\ArticleSource;
use Domain\Articles\Models\Article;

class NewsApiFetcherAction
{


    private StoreNewsApiData $storeNewsApiData;

    public function __construct()
    {
        $this->storeNewsApiData = new StoreNewsApiData();
    }

    public function execute(): void
    {
        $page = 1;

        do {
            $connector = new NewsConnector();
            $response = $connector->send(new ArticlesRequest($page));
            $data = $response->json();

            $this->storeNewsApiData->execute($data);

            $page++;

        } while (isset($data['articles']) && count($data['articles'])  > 0);

    }

}
