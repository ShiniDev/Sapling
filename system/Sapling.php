<?php

defined("SAFE") or die("Direct access to scripts are not allowed.");

// Configurations, all encapsulated in a class
require_once CONFIG_PATH . "Config.php";

// System Libraries
require_once SYSTEM_PATH . "controller" . SEP . "Controller.php";
require_once SYSTEM_PATH . "model" . SEP . "Model.php";

// Load the framework
require_once SYSTEM_PATH . "core" . SEP . "load.php";
