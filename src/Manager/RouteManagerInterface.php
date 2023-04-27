<?php

declare(strict_types=1);

namespace Chess\Manager;

use Chess\Exceptions\RouterException;
use Chess\Model\Route;

interface RouteManagerInterface
{
    public function get($path, $callable, $name = null): Route;

    public function post($path, $callable, $name = null): Route;

    /**
     * @throws RouterException
     */
    public function run();

    /**
     * @throws RouterException
     */
    public function url($name, $params = []);
}