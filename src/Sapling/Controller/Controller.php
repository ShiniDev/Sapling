<?php

namespace Sapling\Controller;

use Sapling\Config\Directories;
use Sapling\Config\Routes;

/**
 *  Controller Class
 *
 *  Handles communication between views and models
 */
class Controller
{
    private $data = [];
    public function __construct()
    {
    }
    /**
     *  Load View
     *
     *  Loads php files in the view directory.
     */
    public function loadView(string $view_dir, array $data)
    {
        if (!preg_match("#^([a-zA-Z_\-/]+).php$#", $view_dir)) // String has no .php extension
        {
            $view_dir .= '.php';
        }
        if (file_exists(Directories::APP_VIEW . $view_dir)) {
            require_once Directories::APP_VIEW . $view_dir;
        } else {
            require_once Routes::DEFAULT_ERROR_PAGE;
        }
    }
    /**
     *  Load Model
     *
     *  Loads model class in the model directory
     */
    public function loadModel(string $model_dir, ?string $name = NULL)
    {
        if (!preg_match("#^([a-zA-Z_\-]+).php$#", $model_dir)) // String has no .php extension
        {
            $model_dir .= '.php';
        }
        if (file_exists(Directories::APP_MODEL . $model_dir)) {
            // require_once Directories::APP_MODEL . $model_dir;
            $filename = explode('/', $model_dir);
            $filename = preg_replace("#(.php)#", "", $filename); // Remove .php extension
            $filename = $filename[count($filename) - 1]; // Get file name
            $classfilename = "App\\Model\\" . $filename;
            if ($name !== NULL) {
                $filename = $name;
            }
            $this->data[$filename] = new $classfilename; // Instantiate
        }
    }
    // Set properties dynamically
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    // Get properties from the $data array
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );
        return null;
    }
}
