<?php

namespace Config\Parser;

class Ini extends FacebookConfigParser
{
    public function __construct($file)
    {
        if (is_file($file)) {
            $config = parse_ini_file($file, true);
            $this->config = $config['config'] ?? [];
            $this->options = $config['options'] ?? [];
        }
    }
}
