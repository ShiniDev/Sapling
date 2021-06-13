<?php

namespace Sapling\Functions;

use Sapling\Config\Routes;
use Symfony\Component\HttpFoundation\Request;

class Url
{
    public static function baseUrl(): string
    {
        $request = Request::createFromGlobals();
        if (Routes::BASE_URL === '') {
            $http = $request->server->get('HTTPS', 'http');
            $http = $http === 'on' ? 'https' : 'http';
            $httpHost = $request->server->get('HTTP_HOST', 'localhost');
            $phpSelf = $request->server->get('PHP_SELF');
            // public/index.php would always be present as it is the only php file
            // accessible to the world
            $phpSelf = preg_replace('#public/index.php#', '', $phpSelf);
            return sprintf("%s://%s%s", $http, $httpHost, $phpSelf);
        } else {
            return Routes::BASE_URL;
        }
    }

    public static function getUrlController(): string
    {
        $request = Request::createFromGlobals();
        return ucfirst($request->query->get('controller', Routes::DEFAULT_CONTROLLER));
    }

    public static function getUrlFunction(): string
    {
        $request = Request::createFromGlobals();
        $function = $request->query->get('function', Routes::DEFAULT_FUNCTION);
        // There's a possibility that function url is empty
        return $function === "" ? Routes::DEFAULT_FUNCTION : $function;
    }

    public static function getUrlParameters(): array
    {
        $request = Request::createFromGlobals();
        $parameters = $request->query->get('parameters', []);
        if ($parameters === "") {
            $parameters = [];
        }
        if ($parameters) {
            // Seperate parameters by /
            $parameters = explode('/', $parameters);
            // Clear out erroneous parameters eg. // <-- Empty parameter
            $parameters = array_filter($parameters, 'strlen');
            // Readjust index values, clearing empty parameters does not fix index values
            $parameters = array_values($parameters);
        }
        return $parameters;
    }
}
