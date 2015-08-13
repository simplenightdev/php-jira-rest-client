<?php namespace JiraRestApi\Support\Laravel;

use Illuminate\Support\ServiceProvider;
use JiraRestApi\Project\ProjectService;
use JiraRestApi\Issue\IssueService;

use Monolog\Logger as Logger;
use Monolog\Handler\StreamHandler;

class JiraServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app['config']->get('jira', []);

        $this->app['config']->set('jira', array_merge(
            require __DIR__.'/../../config/jira.php',
            $config
        ));

        $config = $this->app['config']->get('jira', []);

        $this->app->bindShared('jiraprojectservice', function () use ($config) {
            $logger = new Logger('JiraClient');

            $logger->pushHandler(new StreamHandler(
                $config['JIRA_LOG_FILE'],
                $this->convertLogLevel($config['JIRA_LOG_LEVEL'])
            ));

            $service = new ProjectService($config);
            $service->setLogger($logger);
            return $service;
        });

        $this->app->bindShared('jiraissueservice', function () use ($config) {

            $logger = new Logger('JiraClient');

            $logger->pushHandler(new StreamHandler(
                $config['JIRA_LOG_FILE'],
                $this->convertLogLevel($config['JIRA_LOG_LEVEL'])
            ));

            $service = new IssueService($config);
            $service->setLogger($logger);
            return $service;
        });
    }

    private function convertLogLevel($log_level)
    {
        if ($log_level == 'DEBUG') {
            return Logger::DEBUG;
        } elseif ($log_level == 'INFO') {
            return Logger::DEBUG;
        } elseif ($log_level == 'WARNING') {
            return Logger::WARNING;
        } elseif ($log_level == 'ERROR') {
            return Logger::ERROR;
        } else {
            return Logger::WARNING;
        }
    }
}
