<?php

namespace JiraRestApi\Search;

class SearchService extends \JiraRestApi\JiraClient
{
    private $uri = '/search';

    const DEFAULT_MAX_RESULTS = 50;

    public function __construct(Array $config)
    {
        parent::__construct($config);
    }

    public function search($jql, $maxResults = self::DEFAULT_MAX_RESULTS, $startAt = 0)
    {
        $data = array(
            'jql' => $jql,
            'maxResults' => $maxResults,
            'startAt' => $startAt,
        );
        $request = json_encode($data);

        $this->log->addInfo("Search issues=\n".$request);

        $ret = $this->exec($this->uri, $request, 'POST');

        $this->log->addInfo("Result=\n".$ret);

        $result = $this->json_mapper->map(
            json_decode($ret), new Result()
        );

        return $result;
    }
}