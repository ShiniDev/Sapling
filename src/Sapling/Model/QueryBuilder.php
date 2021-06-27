<?php

namespace Sapling\Model;

use PDO;
use Sapling\Config\Database;
use Sapling\Functions\Debug;

class QueryBuilder
{
    /**
     *  A PDO object 
     *  @var PDO 
     */
    private $db;
    /**
     *  Table to get data from
     *  @var string
     */
    private $qbTable = "";
    /**
     *  The condition for a specific query
     *  @var array
     */
    private $qbWhere = ['where' => '', 'values' => []];
    /**
     *  The join clause for a specific query
     *  @var string
     */
    private $qbJoin = "";
    /**
     *  The order clause for a specific query
     *  @var string
     */
    private $qbOrder = "";
    /**
     *  The limit clause for a specific query
     *  @var string
     */
    private $qbLimit = "";

    public function __construct()
    {
        // Set PDO, attribute flags
        $attributes = [
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES      => false,
        ];
        $dsn =  Database::DB_TYPE . ":host=" . Database::DB_HOST_NAME
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
     *
     * @return PDOStatement|bool
     */
    protected function prepExec(string $prep_query, ?array $values = null)
    {
        try {
            $stmt = $this->db->prepare($prep_query);
            if ($stmt !== false) {
                $stmt->execute($values);
                return $stmt;
            } else {
                throw new \PDOException("The given query failed to be prepared as a PDOStatement");
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     *  Query
     *
     *  This function is just a try catch wrapper for a default query method
     */
    protected function query(string $query)
    {
        try {
            $stmt = $this->db->query($query);
            if ($stmt !== false) {
                return $stmt;
            } else {
                throw new \PDOException("The given query failed to be prepared as a PDOStatement");
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     *  Get
     * 
     *  Get all column data from all rows
     */
    protected function get()
    {
        if ($this->qbTable === "") {
            Debug::debugClass("Table not set");
            return;
        }
        $query = "SELECT * FROM `{$this->qbTable}` {$this->qbJoin} {$this->qbWhere['where']} {$this->qbOrder} {$this->qbLimit}";
        $_SESSION['QueryBuilder']['lastQuery'] = $query;
        $res = $this->prepExec($query, $this->qbWhere['values']);
        $this->clearAll();
        return $res;
    }
    /**
     *  Select
     * 
     *  Gets data from database.
     *  Note: that this should be called last after setting all the other clauses
     *  @param array $columns The columns to select 
     *  @param bool $backticks Disable if you're getting table data from joins
     */
    protected function select(array $columns, bool $backticks = true)
    {
        if ($this->qbTable === "") {
            Debug::debugClass("Table not set");
            return;
        }
        $query = "SELECT";
        if ($backticks) {
            $query .= " `" . implode("`,`", $columns);
            $query .= "`";
            $this->qbTable = "`{$this->qbTable}`";
        } else {
            $query .= " " . implode(",", $columns);
        }
        $query .= " FROM {$this->qbTable} {$this->qbJoin} {$this->qbWhere['where']} {$this->qbOrder} {$this->qbLimit}";
        if (empty($this->qbWhere['values'])) {
            $this->qbWhere['values'] = null;
        }
        $_SESSION['QueryBuilder']['lastQuery'] = $query;
        $res = $this->prepExec($query, $this->qbWhere['values']);
        $this->clearAll();
        return $res;
    }
    /**
     *  Insert
     * 
     *  Inserts data to the database.
     *  Note: that this should be called last after setting all the other clauses
     *  @param array $columns The columns of a table
     *  @param array $values The values corresponding to the columns
     */
    protected function insert(array $columns, array $values)
    {
        if ($this->qbTable === "") {
            Debug::debugClass("Table not set");
            return;
        }
        if (count($columns) !== count($values)) {
            Debug::debugClass('Columns length should be equal to values length');
            return;
        }
        $bindings = [];
        for ($i = 0, $len = count($values); $i < $len; ++$i) {
            $bindings[] = "?";
        }
        $query = "INSERT INTO `{$this->qbTable}` (`" . implode("`,`", $columns) . "`) VALUES (" . implode(",", $bindings) . ")";
        $_SESSION['QueryBuilder']['lastQuery'] = $query;
        $res = $this->prepExec($query, $values);
        $this->clearAll();
        return $res;
    }
    /**
     *  Update
     * 
     *  Update a specific row in a table.
     *  Note: that this should be called last after setting all the other clauses
     *  @param array $columns The columns to update
     *  @param array $values The corresponding values to the given columns
     */
    protected function update(array $columns, array $values)
    {
        if ($this->qbTable === "") {
            Debug::debugClass('Table not set');
            return;
        }
        if (count($columns) !== count($values)) {
            Debug::debugClass('Columns length should be equal to values length');
            return;
        }
        if ($this->qbWhere['where'] === "") {
            Debug::debugClass('Where clause should not be empty when updating data');
            return;
        }
        $query = "UPDATE `{$this->qbTable}` SET `" . implode("` = ?,`", $columns) . "` = ? {$this->qbWhere['where']}";
        for ($i = 0, $len = count($this->qbWhere['values']); $i < $len; ++$i) {
            $values[] = $this->qbWhere['values'][$i];
        }
        $_SESSION['QueryBuilder']['lastQuery'] = $query;
        $res = $this->prepExec($query, $values);
        $this->clearAll();
        return $res;
    }
    /**
     *  Delete
     * 
     *  Delete a specific row in a table
     */
    protected function delete()
    {
        if ($this->qbTable === "") {
            Debug::debugClass('Table not set');
            return;
        }
        if ($this->qbWhere['where'] === "") {
            Debug::debugClass('Where clause should not be empty when deleting data');
            return;
        }
        $query = "DELETE FROM `{$this->qbTable}` {$this->qbWhere['where']}";
        $_SESSION['QueryBuilder']['lastQuery'] = $query;
        $res = $this->prepExec($query, $this->qbWhere['values']);
        $this->clearAll();
        return $res;
    }
    /**
     *  Table
     *  
     *  Sets the table to get the data from
     *  @param string $table
     */
    protected function table(string $table)
    {
        $this->qbTable = $table;
    }
    /**
     *  Join
     * 
     *  Sets the join clause of the query
     *  @param string $joinType The type of join to use
     *  @param string $table The table to join
     *  @param string $condition The on condition
     */
    protected function join(string $joinType, string $table, string $condition)
    {
        $joinType = strtoupper($joinType);
        if ($joinType === "INNER" || $joinType === "LEFT" || $joinType === "RIGHT" || $joinType === "OUTER") {
            if ($joinType === "OUTER") {
                $joinType = "FULL OUTER";
            }
            $this->qbJoin .= "{$joinType} JOIN {$table} ON {$condition}";
        } else {
            Debug::debugClass('Invalid join type');
        }
    }
    /**
     *  Where Manual
     * 
     *  A method to set the where clause manually.
     *  @param string $where The where clause setted by user
     */
    protected function whereManual(string $where, array $value)
    {
        if (!preg_match("/[?]+/", $where)) {
            Debug::debugClass('Manual where clause must always be binded by ?');
            return;
        }
        $totalBindings = 0;
        for ($i = 0, $len = strlen($where); $i < $len; ++$i) {
            if ($where[$i] === '?') {
                ++$totalBindings;
            }
        }
        if ($totalBindings !== count($value)) {
            Debug::debugClass('All the bindings must equal to the number of values');
            return;
        }
        $this->qbWhere['where'] = $where;
        $this->qbWhere['values'] = $value;
    }
    /**
     *  Where Specific
     * 
     *  A method that appends and sets the specific column and its value
     *  one by one.
     *  @param string $column The column to append
     *  @param mixed $value The value corresponding to the column
     *  @param string $operator The operator to use
     *  @param string $prependLogical The logical operator to use 
     */
    protected function whereSpecific(string $column, mixed $value, string $operator, bool $and = true)
    {
        if (is_iterable($value) || is_callable($value) || is_object($value)) {
            Debug::debugClass('Value should not be an array, function or an object');
            return;
        }
        $prependLogical = $and ? "AND" : "OR";
        if ($this->qbWhere['where'] === "") {
            $this->qbWhere['where'] = "WHERE {$column} {$operator} ?";
        } else {
            $this->qbWhere['where'] = " {$prependLogical} {$column} {$operator} ?";
        }
        $this->qbWhere['values'][] = $value;
    }
    /**
     *  Where Many
     * 
     *  A method that sets the where clause based on the given columns and values
     *  @param array $columns The columns to use
     *  @param array $values The column values 
     *  @param string $operator The operator to use in where clause
     *  @param bool $and Tells whether to use AND or OR
     */
    protected function whereMany(array $columns, array $values, string $operator = "=", bool $and = true)
    {
        if (count($columns) !== count($values)) {
            Debug::debugClass('Columns length is not equal to values length');
            return;
        }
        $seperator = $and ? "AND" : "OR";
        $this->qbWhere['where'] = "WHERE " . implode(" {$operator} ? {$seperator} ", $columns);
        $this->qbWhere['where'] .= " {$operator} ? ";
        $this->qbWhere['values'] = $values;
    }
    /**
     *  Order
     * 
     *  Sorts the result of the query
     *  @param string $column The column to base the sorting from
     *  @param bool $ascending True if ascending else descending
     */
    protected function order(string $column, bool $ascending = true)
    {
        $direction = $ascending ? "ASC" : "DESC";
        if ($this->qbOrder === "") {
            $this->qbOrder = "ORDER BY `{$column}` {$direction}";
        } else {
            $this->qbOrder = ", `{$column}` {$direction}";
        }
    }
    /**
     *  Limit
     * 
     *  Limits the result of the query
     *  @param int $limit Limit of the rows
     *  @param int $offset Offset from 0
     */
    protected function limit(int $limit, int $offset = 0)
    {
        $this->qbLimit = "LIMIT {$offset}, $limit";
    }
    public function getLastQuery(): string
    {
        return $_SESSION['QueryBuilder']['lastQuery'];
    }
    /**
     *  Clear All
     *  
     *  Clear all the class properties, to set up a new fresh query
     */
    private function clearAll()
    {
        $this->qbJoin = "";
        $this->qbLimit = "";
        $this->qbOrder = "";
        $this->qbTable = "";
        $this->qbWhere = ['where' => '', 'values' => []];
    }
}
