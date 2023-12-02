<?php

namespace App\FrontEnd\Controllers\Queries;

use Domain\Articles\Models\Article;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleIndexQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Article::query()->with('media');
        parent::__construct($query);
        $this
            ->allowedFilters(
                [ 'title','content']
            )->defaultSort('-id');
    }

}
