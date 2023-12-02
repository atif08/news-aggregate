<?php

namespace App\Http\Integrations\NewYorkTime;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class NewYorkTimeConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.nytimes.com/svc/search/v2';
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultQuery(): array
    {
        return [
            "api-key"=>config('app.new_york_time_token')
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
