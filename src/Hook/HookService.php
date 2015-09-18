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

        $this->log->addInfo("Result=\n".$ret);

        $hooks = $this->json_mapper->mapArray(json_decode($ret), [], Hook::class);

        return $hooks;
    }

    public function create(Hook $hook)
    {
        $data = json_encode($hook);
        $this->log->addInfo("Create Hook=\n".$data);
        $ret = $this->exec('webhook', $data, 'POST');

        $this->log->addInfo("Result=\n".$ret);

        $hook = $this->json_mapper->map(
            json_decode($ret), new Hook()
        );

        return $hook;
    }
}