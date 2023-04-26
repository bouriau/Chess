<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Chess\Exceptions\RouterException;
use Chess\Manager\RouteManager;


$router = new RouteManager($_SERVER['REQUEST_URI']);
$router->get('/', 'Chess#index');

try {
    $router->run();
} catch (RouterException $e) {
}
