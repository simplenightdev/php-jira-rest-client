<?php
namespace JiraRestApi\Search;


class Result
{
    /** @var string */
    public $expand;

    /** @var int */
    public $startAt;

    /** @var int */
    public $maxResults;

    /** @var int */
    public $total;

    /** @var \JiraRestApi\Issue\Issue[] */
    public $issues;
}