<?php
require_once __DIR__ . '/../bootstrap.php';

use Config\FacebookConfig;
use Config\Parser\Ini;
use Core\FacebookHelper;

// Ini formatter
$formatter = new Ini(ROOT . '/config.ini');

// Facebook config
$config = new FacebookConfig($formatter);

// Helper class
$helper = new FacebookHelper($config);
$helper->request();