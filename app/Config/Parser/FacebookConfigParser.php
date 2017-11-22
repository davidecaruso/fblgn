<?php

namespace Config\Parser;

use Config\FacebookConfigTrait;

abstract class FacebookConfigParser
{
    use FacebookConfigTrait;
    abstract public function __construct($file);
}
