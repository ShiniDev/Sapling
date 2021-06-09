<?php

use Sapling\system\model\Model as Sapling_Model;

defined("SAFE") or die("Direct access to scripts are not allowed.");

class Test_model extends Sapling_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_test(): array|bool
    {
        // $statement = "SELECT * FROM test";
        // return $this->query($statement)->fetchAll();
        return $this->get("test")->fetchAll();
    }
    public function insert_test(array $data)
    {
        $this->insert("test", $data);
    }
    public function delete_test(string $column, $value)
    {
        $this->delete("test", $column, $value);
    }
    public function delete_many_test(array $columns, array $values, bool $use_and = true)
    {
        $this->delete_many("test", $columns, $values, $use_and);
    }
    public function update_test(array $update_column, array $update_value, string $where_column, $where_value)
    {
        $this->update("test", $update_column, $update_value, $where_column, $where_value);
    }
}
