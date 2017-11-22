<?php

namespace Parsers;

/**
 * Class IniConfigParser
 * PHP version 7.x
 *
 * @category  PHP
 * @package   Parsers
 * @author    Davide Caruso <davide.caruso93@gmail.com>
 * @copyright 2017 Davide Caruso
 * @license   https://github.com/davidecaruso/fblgn/blob/master/LICENSE MIT Licence
 * @link      https://github.com/davidecaruso/fblgn
 */
class IniConfigParser extends ConfigParser
{
    /**
     * Ini constructor.
     *
     * @param string $file Path to ini file
     */
    public function __construct($file)
    {
        if (is_file($file)) {
            $config = parse_ini_file($file, true);
            $this->config = $config['config'] ?? [];
            $this->options = $config['options'] ?? [];
        }
    }
}
