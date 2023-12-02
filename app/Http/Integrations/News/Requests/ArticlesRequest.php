<?php

namespace App\Http\Integrations\News\Requests;

use App\Http\Integrations\News\Dtos\ArticleListingDto;
use Carbon\Carbon;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Response;

class ArticlesRequest extends Request
{
    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            "q"=>"google",
            "from"=>Carbon::yesterday(),
            "to"=>Carbon::now(),
            "sortBy" =>"popularity"
        ];
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/everything';
    }


}
