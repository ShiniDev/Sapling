<?php

namespace Sapling\Config;

// Get the database credentials from database.json

class Database
{
    public const DB = ENV["DATABASE"];
    public const DB_NAME = self::DB['DATABASE_NAME'];
    public const DB_HOST_NAME = self::DB['HOST_NAME'];
    public const DB_USER_NAME = self::DB['USER_NAME'];
    public const DB_PASSWORD = self::DB['PASSWORD'];
    public const DB_CHARSET = self::DB['CHARSET'];
}
