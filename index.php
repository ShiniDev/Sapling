<?php

define("SEP", DIRECTORY_SEPARATOR);
define("SAFE", TRUE);
define("SYSTEM_PATH", __DIR__ . SEP . "system" . SEP);
define("CONFIG_PATH", __DIR__ . SEP . "config" . SEP);
define("APP_PATH", __DIR__ . SEP . "app" . SEP);
define("BASE_PATH", __DIR__ . SEP);

require_once SYSTEM_PATH . "Sapling.php";
