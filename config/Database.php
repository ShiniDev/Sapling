<?php

namespace Sapling\config;

defined("SAFE") or die("Direct access to scripts are not allowed.");
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
    public const DATABASE = "shini";
    public const HOST = "localhost";
    public const NAME = "root";
    public const PASSWORD = "";
    public const CHARSET = "utf8mb4";
}
