<?php

namespace Sapling\system\controller;

defined("SAFE") or die("Direct access to scripts are not allowed.");

use Sapling\config\Directories;

/**
 *  @Author: ShiniDev
 *  @File Created: June 8, 2021
 *  @Last Edited: June 8, 2021
 */
/**
 *  Controller Class
 * 
 *  Handles communication between views and models
 */
class Controller
{
    private $data = [];
    protected function __construct()
    {
    }
    /**
     *  Load View
     * 
     *  Loads php files in the view directory.
     */
    public function load_view(string $view_dir, array $data)
    {
        if (file_exists(Directories::APP_VIEW . $view_dir))
        {
            require_once Directories::APP_VIEW . $view_dir;
        }
    }
    /**
     *  Load Model
     * 
     *  Loads model class in the model directory
     */
    public function load_model(string $model_dir)
    {
        if (!preg_match("#^([a-zA-Z_\-]+).php$#", $model_dir))
        {
            $model_dir .= '.php';
        }
        if (file_exists(Directories::APP_MODEL . $model_dir))
        {
            require_once Directories::APP_MODEL . $model_dir;
            $filename = explode('/', $model_dir);
            $filename = preg_replace("#(.php)#", "", $filename);
            $filename = $filename[count($filename) - 1]; // Get file name
            $this->data[$filename] = new $filename;
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
        if (array_key_exists($name, $this->data))
        {
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
