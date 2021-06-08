<?php

namespace Sapling\system\model;

defined("SAFE") or die("Direct access to scripts are not allowed.");

use PDO;
use PDOStatement;
use Sapling\config\Database;

/**
 *  @Author: ShiniDev
 *  @File Created: June 5, 2021
 *  @Last Edited: June 8, 2021
 */
/**
 *  Model
 * 
 *  A class for communicating to the database 
 */
class Model
{
    // PDO Object
    protected $db;
    protected function __construct()
    {
        // Set PDO, attribute flags
        $attributes = [
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES      => false,
        ];
        $dsn = "mysql:host=" . Database::HOST . ";dbname=" . Database::DATABASE . ";charset=" . Database::CHARSET;
        try
        {
            $this->db = new PDO($dsn, Database::NAME, Database::PASSWORD, $attributes);
        }
        catch (\PDOException $e)
        {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     *  Prepare and Execute
     *  
     *  This function is just a try catch wrapper for a default prep exec process
     */
    protected function prep_exec(string $prep_query, array $values): PDOStatement|bool
    {
        try
        {
            $stmt = $this->db->prepare($prep_query);
            $stmt->execute($values);
            return $stmt;
        }
        catch (\PDOException $e)
        {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     *  Query
     * 
     *  This function is just a try catch wrapper for a default query method
     */
    protected function query(string $query): PDOStatement|bool
    {
        try
        {
            return $this->db->query($query);
        }
        catch (\PDOException $e)
        {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
