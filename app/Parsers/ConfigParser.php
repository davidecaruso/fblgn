<?php

namespace Parsers;

use Config\FacebookConfigTrait;

/**
 * Class ConfigParser
 * PHP version 7.x
 *
 * @category  PHP
 * @package   Parsers
 * @author    Davide Caruso <davide.caruso93@gmail.com>
 * @copyright 2017 Davide Caruso
 * @license   https://github.com/davidecaruso/fblgn/blob/master/LICENSE MIT Licence
 * @link      https://github.com/davidecaruso/fblgn
 */
abstract class ConfigParser
{
    use FacebookConfigTrait;

    /**
     * Ini constructor.
     *
     * @param string $file Path to config file
     */
    abstract public function __construct($file);
}
