<?php

namespace App\Http\Integrations\Guardian\Requests;

use App\Http\Integrations\News\Dtos\ArticleListingDto;
use Illuminate\Support\Carbon;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Response;

class SearchRequest extends Request
{
    public function __construct(private readonly int $page)
    {
    }

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
            "page" => $this->page,
            "q" => "12 years slave",
            "from-date" => Carbon::yesterday()
        ];
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/search?q=&format=json&tag=film/film,tone/reviews&&show-tags=contributor&show-fields=body,thumbnail&order-by=relevance';
    }

//    public function createDtoFromResponse(Saloon\Http\Response $response)
//    {
//        return ArticleListingDto::fromResponse($response);
//    }
}
