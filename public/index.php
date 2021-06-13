<?php

define("SEP", DIRECTORY_SEPARATOR);

define("BASE_PATH", dirname(dirname(__FILE__)) . SEP);

define("RESOURCE_PATH", BASE_PATH . "resources" . SEP);
define("SOURCE_PATH", BASE_PATH . "src" . SEP);
define("CONFIG_PATH", BASE_PATH . "config" . SEP);

define("SYSTEM_PATH", SOURCE_PATH . "Sapling" . SEP);
define("APP_PATH", SOURCE_PATH . "App" . SEP);

define("CORE_PATH", SYSTEM_PATH . "Core" . SEP);

require_once BASE_PATH . "vendor" . SEP . "autoload.php";
require_once CORE_PATH . "core.php";
