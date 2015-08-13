<?php

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;

        case 'emtpy':
        case '(empty)':
            return '';

        case 'null':
        case '(null)':
            return;
        }

        if (startsWith($value, '"') && endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (! function_exists('startsWith')) {
    function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) === 0) {
                return true;
            }
        }
        return false;
    }
}

if (! function_exists('endsWith')) {
    function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }
        return false;
    }
}

return [
    'JIRA_HOST' => env('JIRA_HOST'),
    'JIRA_USER' => env('JIRA_USER'),
    'JIRA_PASS' => env('JIRA_PASS'),
    'JIRA_LOG_FILE' => env('JIRA_LOG_FILE', 'jira-rest-client.log'),
    'JIRA_LOG_LEVEL' => env('JIRA_LOG_LEVEL', 'WARNING'),

    'CURLOPT_SSL_VERIFYHOST' => env('CURLOPT_SSL_VERIFYHOST', false),
    'CURLOPT_SSL_VERIFYPEER' => env('CURLOPT_SSL_VERIFYPEER', false),
    'CURLOPT_VERBOSE' => env('CURLOPT_VERBOSE', false),
];
