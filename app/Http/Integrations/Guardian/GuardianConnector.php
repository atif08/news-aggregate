<?php

namespace App\Http\Integrations\Guardian;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class GuardianConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'https://content.guardianapis.com';
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return ["api-key"=>config("app.guardian_token")];
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
