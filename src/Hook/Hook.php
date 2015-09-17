<?php

namespace JiraRestApi\Hook;


class Hook implements \JsonSerializable
{
    const EVENT_CREATED = 'jira:issue_created';
    const EVENT_UPDATED = 'jira:issue_updated';

    /** @var string */
    public $name;

    /** @var string */
    public $url;

    /** @var string[] */
    public $events = array();

    public $filters;

    /** @var bool */
    public $excludeBody = false;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}