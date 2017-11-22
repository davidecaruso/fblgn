<?php

namespace Core;

use Config\FacebookConfig;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class FacebookHelper
{
    private $config;
    private $facebook;
    private $helper;
    private $options;

    public function __construct(FacebookConfig $facebookConfig)
    {
        // Load config
        $this->config = $facebookConfig->getConfig();
        $this->options = $facebookConfig->getOptions();

        // Init Facebook
        $this->facebook = new Facebook($this->config);
        $this->helper = $this->facebook->getRedirectLoginHelper();
    }

    public function getAccessToken(): string
    {
        // Get previous access token
        $accessToken = $_SESSION['access_token'] ?? null;

        // If is empty request a new access token
        if (!$accessToken) {
            try {
                $accessToken = (string) $this->helper->getAccessToken();
                $_SESSION['access_token'] = $accessToken;
            } catch (FacebookSDKException $e) {
                echo $e->getMessage();
                if ($this->helper->getError()) {
                    var_dump($this->helper->getError());
                    var_dump($this->helper->getErrorCode());
                    var_dump($this->helper->getErrorReason());
                    var_dump($this->helper->getErrorDescription());
                }
                die(1);
            }
        }
        return $accessToken;
    }

    public function request()
    {
        $accessToken = $this->getAccessToken();
        if (!empty($accessToken)) {
            $endpoint = $this->getEndpoint();
            $response = $this->facebook->get($endpoint);
            echo '<pre>', var_dump($response, true); die();
        } else {
            $this->printLoginUrl();
        }
    }

    public function getEndpoint()
    {
        $appId = $this->config['app_id'];
        $requestPath = $this->options['request_path'];

        $accessToken = $this->getAccessToken();
        $metrics = json_encode($this->options['metrics']);
        $query = ['metrics' => $metrics, 'access_token' => $accessToken];

        return "/{$appId}/{$requestPath}/?" . http_build_query($query);
    }

    public function printLoginUrl()
    {
        $loginUrl = $this->helper->getLoginUrl($this->options['redirect_url'], $this->options['scope']);
        print "<a href=\"{$loginUrl}\">Log in with Facebook</a>";
        die(0);
    }
}
