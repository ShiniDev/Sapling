<?php

namespace Sapling\Config;

// Get the database credentials from database.json

define('DATABASE', json_decode(file_get_contents(CONFIG_PATH . "database.json"), true));

class Database
{
    public const DB = DATABASE;
    public const DB_NAME = self::DB['databaseName'];
    public const DB_HOST_NAME = self::DB['hostName'];
    public const DB_USER_NAME = self::DB['name'];
    public const DB_PASSWORD = self::DB['password'];
    public const DB_CHARSET = self::DB['charset'];
}
