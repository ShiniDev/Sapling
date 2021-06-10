<?php

define("SEP", DIRECTORY_SEPARATOR);
define("BASE_PATH", dirname(dirname(__FILE__)) . SEP);
define("SYSTEM_PATH", BASE_PATH . "system" . SEP);
define("CONFIG_PATH", SYSTEM_PATH . "config" . SEP);
define("CORE_PATH", SYSTEM_PATH . "core" . SEP);
define("APP_PATH", BASE_PATH . "app" . SEP);

require_once BASE_PATH . "vendor" . SEP . "autoload.php";
require_once SYSTEM_PATH . "core" . SEP . "core.php";
