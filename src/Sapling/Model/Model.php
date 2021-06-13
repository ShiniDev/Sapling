<?php

namespace Sapling\Model;

use PDO;
use PDOStatement;
use Sapling\Config\Database;

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
        $dsn = "mysql:host=" . Database::DB_HOST_NAME
            . ";dbname=" . Database::DB_NAME
            . ";charset=" . Database::DB_CHARSET;
        try {
            $this->db = new PDO($dsn, Database::DB_USER_NAME, Database::DB_PASSWORD, $attributes);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     *  Prepare and Execute
     *  
     *  This function is just a try catch wrapper for a default prep exec process
     */
    protected function prepExec(string $prep_query, array $values): PDOStatement|bool
    {
        try {
            return $this->db->prepare($prep_query)->execute($values);
        } catch (\PDOException $e) {
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
        try {
            return $this->db->query($query);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     *  Get
     * 
     *  This function is an abstraction for select queries,
     *  you can leave the $columns parameter empty for * select
     * 
     *  @param string $table The table to get data from
     *  @param array|null $columns The specific column to retrieve
     *  @return PDOStatement|bool 
     */
    protected function get(string $table, array $columns = null): PDOStatement|bool
    {
        $query = "SELECT ";
        if ($columns != null) {
            for ($i = 0; $i < count($columns); ++$i) {
                $query .= $i + 1 < count($columns) ? $this->db->quote(strval($columns[$i])) . ", " : $this->db->quote(strval($columns[$i])) . " ";
            }
        } else {
            $query .= " * ";
        }
        $query .= " FROM `$table`";
        return $this->query($query);
    }
    /**
     *  Insert
     * 
     *  This function is an abstraction for insert queries.
     *  Set the $has_id to false, if the table has no primary keys
     * 
     *  @param string $table The table to insert data to
     *  @param array $data The values of the column fields
     *  @param bool $has_id Set to false, if no primary key or id is specified
     *  @return PDOStatement|bool
     */
    protected function insert(string $table, array $data, bool $has_id = true): PDOStatement|bool
    {
        $num_fields = $this->get($table)->columnCount();
        $query = "INSERT INTO `$table` VALUES (";
        for ($i = 0; $i < $num_fields; ++$i) {
            if ($i == 0 && $has_id) {
                $query .= "NULL,";
            } else {
                $query .= $i + 1 < $num_fields ? "?," : "?)";
            }
        }
        return $this->prepExec($query, $data);
    }
    /**
     *  Delete
     *  
     *  This function is an abstraction for delete queries
     * 
     *  @param string $table The table to delete data from
     *  @param string $column_identifier The column field to find
     *  @param string $column_value The value to match
     */
    protected function delete(string $table, string $column_identifier, $column_value): PDOStatement|bool
    {
        $query = "DELETE FROM `$table` WHERE ";
        $query .= $this->db->quote($column_identifier) . " = ?";
        return $this->prepExec($query, [$column_value]);
    }
    /**
     *  Delete Many
     *  
     *  This function is an abstraction for delete queries,
     *  you can use multiple column identifiers and multiple column values.
     *  Set the $use_and to false to use OR statements else it uses AND statements
     * 
     *  @param string $table The table to delete data from
     *  @param array $column_identifier The column fields to match
     *  @param array $column_value The column values to match
     *  @param bool $use_and Flag to use AND or OR statements
     *  @return PDOStatement|bool
     */
    protected function deleteMany(string $table, array $column_identifier, array $column_value, bool $use_and = true): PDOStatement|bool
    {
        $query = "DELETE FROM `$table` WHERE ";
        $logical = $use_and ? "AND" : "OR";
        for ($i = 0; $i < count($column_identifier); ++$i) {
            $query .= $this->db->quote($column_identifier[$i]) . " = ? ";
            $query .= $i + 1 < count($column_identifier) ? $logical . " " : "";
        }
        return $this->prepExec($query, $column_value);
    }
    /**
     *  Update
     *  
     *  This function is an abstraction for update queries,
     *  you can use multiple update column identifiers for variadic parameters.
     * 
     *  @param string $table The table to update data from
     *  @param array $update_column The column field to update
     *  @param array $update_value The column value to put 
     *  @param string $where_column The row to change
     *  @param mixed $where_value The value of the row to find
     *  @return PDOStatement|bool
     */
    protected function update(string $table, array $update_column, array $update_value, string $where_column, $where_value): PDOStatement|bool
    {
        $query = "UPDATE `$table` SET ";
        for ($i = 0; $i < count($update_column); ++$i) {
            $query .= $this->db->quote($update_column[$i]) . " = ?";
            $query .= $i + 1 < count($update_column) ? ", " : " ";
        }
        $query .= "WHERE " . $this->db->quote($where_column) . " = ?";
        $data = $update_value;
        array_push($data, $where_value);
        return $this->prepExec($query, $data);
    }
}
