<?php
// Get the database credentials from database.json
$db = json_decode(file_get_contents(CONFIG_PATH . "database.json"), true);

define('DB_NAME', $db['databaseName']);
define('DB_HOST_NAME', $db['hostName']);
define('DB_USER_NAME', $db['name']);
define('DB_PASSWORD', $db['password']);
define('DB_CHARSET', $db['charset']);
