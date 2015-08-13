<?php

namespace JiraRestApi\Support\Laravel;

use Illuminate\Support\Facades\Facade;

class JiraProject extends Facade
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
        return "jiraprojectservice";
    }
}
