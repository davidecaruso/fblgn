<?php

namespace Config;

use Parsers\ConfigParser;

/**
 * Class FacebookConfig
 * PHP version 7.x
 *
 * @category  PHP
 * @package   Config
 * @author    Davide Caruso <davide.caruso93@gmail.com>
 * @copyright 2017 Davide Caruso
 * @license   https://github.com/davidecaruso/fblgn/blob/master/LICENSE MIT Licence
 * @link      https://github.com/davidecaruso/fblgn
 */
class FacebookConfig
{
    use FacebookConfigTrait;

    /**
     * FacebookConfig constructor.
     *
     * @param \Parsers\ConfigParser $parser Parser object
     */
    public function __construct(ConfigParser $parser)
    {
        $this->config = $parser->getConfig();
        $this->options = $parser->getOptions();
    }
}