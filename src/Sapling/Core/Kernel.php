<?php

namespace Sapling\Core;

use Sapling\Functions\Url;
use Sapling\Config\Directories;
use Sapling\Config\Routes;

class Kernel
{
    /**
     *  The controller class to be called
     *  @var string
     */
    private static string $controller;
    /**
     *  The function of the controller to be called
     *  @var string
     */
    private static string $function;
    /**
     *  The parameters of the function being called
     *  @var array
     */
    private static array $parameters;
    /**
     *  A flag to check the run() method
     *  @var bool
     */
    private static bool $isRunned = FALSE;

    private static function set()
    {
        self::$controller = Url::getUrlController();
        self::$function = Url::getUrlFunction();
        self::$parameters = Url::getUrlParameters();
    }

    public static function run(): void
    {
        if (self::$isRunned) {
            throw new \Exception("Error: Kernel::run() called twice");
        } else {
            self::$isRunned = TRUE;
            self::set();
            session_start();
            if (file_exists(Directories::APP_CONTROLLER . self::$controller . ".php")) {
                self::$controller = "App\\Controller\\" . self::$controller;
                $controller = new self::$controller;

                if (method_exists(self::$controller, (string)self::$function)) {
                    $controller->{self::$function}(self::$parameters);
                } else {
                    require_once Routes::DEFAULT_ERROR_PAGE;
                }
            } else if (self::$controller === "") {
                self::$controller = "App\\Controller\\" . Routes::DEFAULT_CONTROLLER;
                $controller = new self::$controller;

                if (method_exists(self::$controller, (string)self::$function)) {
                    $controller->{self::$function}(self::$parameters);
                } else {
                    require_once Routes::DEFAULT_ERROR_PAGE;
                }
            } else {
                require_once Routes::DEFAULT_ERROR_PAGE;
            }
        }
    }
}
