<?php

use Sapling\Config\Directories;
use Sapling\Config\Routes;
use Sapling\Functions\Url;

$url['controller'] = Url::getUrlController();
$url['function'] = Url::getUrlFunction();
$url['parameters'] = Url::getUrlParameters();

if (file_exists(Directories::APP_CONTROLLER . $url['controller'] . ".php")) {
    $url['controller'] = "App\\Controller\\" . $url['controller'];
    $url['controller'] = new $url['controller'];

    if (method_exists($url['controller'], (string)$url['function'])) {
        $url['controller']->{$url['function']}($url['parameters']);
    } else {
        require_once Routes::DEFAULT_ERROR_PAGE;
    }
} else if ($url['controller'] === "") {
    $url['controller'] = "App\\Controller\\" . Routes::DEFAULT_CONTROLLER;
    $url['controller'] = new $url['controller'];

    if (method_exists($url['controller'], (string)$url['function'])) {
        $url['controller']->{$url['function']}($url['parameters']);
    } else {
        require_once Routes::DEFAULT_ERROR_PAGE;
    }
} else {
    require_once Routes::DEFAULT_ERROR_PAGE;
}
