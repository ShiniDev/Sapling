<?php

namespace Sapling\system\config;

/**
 *  @Author: ShiniDev
 *  @File Created: June 5, 2021
 *  @Last Edited: June 5, 2021
 */

/**
 *  Changed const variables to configure what
 *  database to connect to.
 */
class Database
{
    public const DATABASE = DB_NAME;
    public const HOST = DB_HOST_NAME;
    public const NAME = DB_USER_NAME;
    public const PASSWORD = DB_PASSWORD;
    public const CHARSET = DB_CHARSET;
}
