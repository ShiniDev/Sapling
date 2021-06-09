<?php

defined("SAFE") or die("Direct access to scripts are not allowed.");

$includes = [
  
  CONFIG_PATH . "Config.php",
  SYSTEM_PATH . "controller" . SEP . "Controller.php",
  SYSTEM_PATH . "model" . SEP . "Model.php",
  SYSTEM_PATH . "core" . SEP . "load.php"
  
];

foreach ($includes as $include) {
  
   require_once $include;
  
}
