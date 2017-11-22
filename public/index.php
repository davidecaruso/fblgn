<?php

require_once __DIR__ . '/../bootstrap.php';

use Config\FacebookConfig;
use Parsers\IniConfigParser;
use Core\FacebookHelper;

// Ini parser
$parser = new IniConfigParser(ROOT . '/config.ini');

// Facebook config
$config = new FacebookConfig($parser);

// Helper class
$helper = new FacebookHelper($config);
$helper->sendRequest();