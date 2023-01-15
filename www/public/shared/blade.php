<?php
require_once "../src/WEBLogger.php";
$logger = new LOGGER(true);

require_once '../../vendor/autoload.php';

use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);

?>