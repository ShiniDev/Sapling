<?php

namespace Sapling\config;

/**
 *  @Author: ShiniDev
 *  @File_Created: June 8, 2021
 *  @Last_Edited: June 8, 2021
 */
/**
 *  This file loads all the Sapling configs.
 */
defined("SAFE") or die("Direct access to scripts are not allowed.");

$db = json_decode(file_get_contents(CONFIG_PATH . "database.json"), true);

define('DB_NAME', $db['databaseName']);
define('DB_HOST_NAME', $db['hostName']);
define('DB_USER_NAME', $db['name']);
define('DB_PASSWORD', $db['password']);
define('DB_CHARSET', $db['charset']);

require_once "Database.php";
require_once "Directories.php";
require_once "Routes.php";
