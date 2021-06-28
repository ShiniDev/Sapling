<?php

namespace Sapling\Functions;

use Sapling\Config\Routes;
use Symfony\Component\HttpFoundation\Request;

class Url
{
    private static ?Request $request = NULL;

    private static function createRequest(): void
    {
        if (self::$request === NULL) {
            self::$request = Request::createFromGlobals();
        }
    }

    public static function resourceUrl(): string
    {
        self::createRequest();
        return self::baseUrl() . "resources/";
    }

    public static function redirect(string $url): void
    {
        header('Location: ' . $url);
    }

    public static function baseUrl(): string
    {
        self::createRequest();
        if (Routes::BASE_URL === '') {
            $http = self::$request->server->get('HTTPS', 'http');
            $http = $http === 'on' ? 'https' : 'http';
            $httpHost = self::$request->server->get('HTTP_HOST', 'localhost');
            $phpSelf = self::$request->server->get('PHP_SELF');
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
        self::createRequest();
        return ucfirst(self::$request->query->get('controller', ""));
    }

    public static function getUrlFunction(): string
    {
        self::createRequest();
        $function = self::$request->query->get('function', Routes::DEFAULT_FUNCTION);
        // There's a possibility that function url is empty
        return $function === "" ? Routes::DEFAULT_FUNCTION : $function;
    }

    public static function getUrlParameters(): array
    {
        self::createRequest();
        $parameters = self::$request->query->get('parameters', []);
        if ($parameters === "") {
            $parameters = [];
        }
        if ($parameters) {
            // Seperate parameters by /
            $parameters = explode('/', $parameters);
            // Clear out erroneous parameters eg. // <-- Empty parameter
            $parameters = array_filter($parameters, 'strlen');
            // Re-adjust index values, clearing empty parameters does not fix index values
            $parameters = array_values($parameters);
            // Replace + to space
            for ($i = 0, $len = count($parameters); $i < $len; ++$i) {
                for ($j = 0, $lenk = strlen($parameters[$i]); $j < $lenk; ++$j) {
                    if ($parameters[$i][$j] === '+') {
                        $parameters[$i][$j] = ' ';
                    }
                }
            }
        }
        return $parameters;
    }
}
