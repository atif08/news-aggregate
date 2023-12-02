<?php

namespace App\Http\Integrations\News;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class NewsConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'https://newsapi.org/v2';
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            "x-api-key"=>config('app.news_api_token')
        ];
    }

    /**
     * Default HTTP client options
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
