<?php

namespace Config;

use Config\Parser\FacebookConfigParser;

class FacebookConfig
{
    use FacebookConfigTrait;
    public function __construct(FacebookConfigParser $parser)
    {
        $this->config = $parser->getConfig();
        $this->options = $parser->getOptions();
    }
}