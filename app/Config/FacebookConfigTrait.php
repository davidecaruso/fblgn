<?php

namespace Config;

trait FacebookConfigTrait
{
    protected $config = [];
    protected $options = [];

    /**
     * Get config for Facebook super-class object.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get options for Facebook requests.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
