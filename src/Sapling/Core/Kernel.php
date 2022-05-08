<?php

namespace Sapling\Core;

use Sapling\Config\Debug as ConfigDebug;
use Sapling\Functions\Url;
use Sapling\Config\Directories;
use Sapling\Config\Routes;
use Sapling\Functions\Debug;

class Kernel
{
    /**
     *  The controller class to be called
     *  @var string
     */
    private static $controller;
    /**
     *  The function of the controller to be called
     *  @var string
     */
    private static $function;
    /**
     *  The parameters of the function being called
     *  @var array
     */
    private static $parameters;
    /**
     *  A flag to check the run() method
     *  @var bool
     */
    private static $isRunned = FALSE;

    /**
     *  Sets the Kernel properties
     */
    private static function set()
    {
        self::$controller = Url::getUrlController();
        self::$function = Url::getUrlFunction();
        self::$parameters = Url::getUrlParameters();
    }

    /**
     *  Runs the framework
     */
    public static function run(): void
    {
        if (self::$isRunned) {
            Debug::debugClass("Error: Kernel::run() called twice");
            Debug::die("Error: Kernel::run() called twice");
        } else {
            self::$isRunned = TRUE;
            self::set();
            session_start();
            if (file_exists(Directories::APP_CONTROLLER . self::$controller . ".php")) {
                self::$controller = "App\\Controller\\" . self::$controller;
                $controller = new self::$controller;

                if (method_exists(self::$controller, (string)self::$function)) {
                    // $controller->{self::$function}(self::$parameters);
                    $reflection = new \ReflectionMethod(self::$controller, (string)self::$function);
                    $minParams = $reflection->getNumberOfRequiredParameters(); // Minimum parameters required
                    $maxParams = $reflection->getNumberOfParameters(); // Maximum parameters required
                    $params = count(self::$parameters); // Parameters given
                    if ($params >= $minParams && $params <= $maxParams) {
                        call_user_func_array([$controller, self::$function], self::$parameters);
                    } else {
                        Debug::debugClass('Invalid parameter arguments: expected ' . $minParams . ' args, but given ' . $params . ' instead');
                        Debug::die('Invalid parameter arguments.');
                    }
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
