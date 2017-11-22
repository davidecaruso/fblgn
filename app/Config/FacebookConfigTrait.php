<?php

namespace Config;

trait FacebookConfigTrait
{
    protected $config;
    protected $options;

    public function getConfig()
    {
        return $this->config;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
