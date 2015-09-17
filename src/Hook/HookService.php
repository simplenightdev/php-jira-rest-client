<?php
namespace JiraRestApi\Hook;

use JiraRestApi\JiraClient;

class HookService extends JiraClient
{
    protected $api_uri = '/rest/webhooks/1.0';

    /**
     * @return Hook[]
     * @throws \JiraRestApi\JIRAException
     */
    public function index()
    {
        $ret = $this->exec('webhook');

        $hooks = $this->json_mapper->mapArray(json_decode($ret), [], Hook::class);

        return $hooks;
    }

    public function create(Hook $hook)
    {
        $ret = $this->exec('webhook', json_encode($hook), 'POST');

        $hook = $this->json_mapper->map(
            json_decode($ret), new Hook()
        );

        return $hook;
    }
}