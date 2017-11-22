<?php

namespace Core;

use Config\FacebookConfig;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

/**
 * Class FacebookHelper
 * PHP version 7.x
 *
 * @category  PHP
 * @package   Core
 * @author    Davide Caruso <davide.caruso93@gmail.com>
 * @copyright 2017 Davide Caruso
 * @license   https://github.com/davidecaruso/fblgn/blob/master/LICENSE MIT Licence
 * @link      https://github.com/davidecaruso/fblgn
 */
class FacebookHelper
{
    protected $config;
    protected $facebook;
    protected $helper;
    protected $options;

    /**
     * FacebookHelper constructor.
     *
     * @param \Config\FacebookConfig $facebookConfig Facebook Config object
     */
    public function __construct(FacebookConfig $facebookConfig)
    {
        // Load config
        $this->config = $facebookConfig->getConfig();
        $this->options = $facebookConfig->getOptions();

        // Init Facebook
        $this->facebook = new Facebook($this->config);
        $this->helper = $this->facebook->getRedirectLoginHelper();
    }

    /**
     * Return a valid Access Token and set it into session
     *
     * @return null|string
     */
    public function getAccessToken()
    {
        $accessToken = null;

        // If is empty request a new access token
        if (!isset($_SESSION['access_token']) || empty($_SESSION['access_token'])) {
            try {
                // Short lived
                $accessToken = (string) $this->helper->getAccessToken();
                // Long lived
                $oac = $this->facebook->getOAuth2Client();
                $accessToken = (string) $oac->getLongLivedAccessToken($accessToken);
                // Store into session
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
        } else {
            $accessToken = $_SESSION['access_token'];
        }

        // Set default access token
        if ($accessToken) {
            $this->facebook->setDefaultAccessToken($accessToken);
        }

        return $accessToken;
    }

    /**
     * Send a GET request to Graph.
     *
     * @return void
     */
    public function sendRequest()
    {
        $accessToken = $this->getAccessToken();
        if (!empty($accessToken)) {
            $endpoint = $this->getEndpoint();
            $response = $this->facebook->get($endpoint);
            echo '<pre>', var_dump($response, true);
            die();
        } else {
            $this->login();
        }
    }

    /**
     * Get the complete endpoint path for the request.
     *
     * @return string
     */
    public function getEndpoint()
    {
        $appId = $this->config['app_id'];
        $requestPath = $this->options['request_path'];

        $accessToken = $this->getAccessToken();
        $metrics = json_encode($this->options['metrics']);
        $query = ['metrics' => $metrics, 'access_token' => $accessToken];

        return "/{$appId}/{$requestPath}/?" . http_build_query($query);
    }

    /**
     * Go to the login page.
     *
     * @return void
     */
    public function login()
    {
        $loginUrl = $this->helper->getLoginUrl(
            $this->options['redirect_url'], $this->options['scope']
        );
        header("Location: {$loginUrl}");
        die(0);
    }
}
