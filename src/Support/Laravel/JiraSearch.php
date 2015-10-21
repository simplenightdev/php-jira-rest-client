<?php

namespace JiraRestApi\Support\Laravel;

use Illuminate\Support\Facades\Facade;

class JiraSearch extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return "jirasearchservice";
    }
}
