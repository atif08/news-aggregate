<?php

namespace Domain\Articles\Enums;




enum ArticleSource:string
{
    case NEWS = 'news_api';
    case NEW_YORK_TIME = 'new_york_time';
    case GUARDIAN = 'guardian';
}
