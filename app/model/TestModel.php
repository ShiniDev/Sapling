<?php

namespace Sapling\app\model;

use Sapling\system\model\Model as SaplingModel;

class TestModel extends SaplingModel
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAllTest(): array|bool
    {
        // $statement = "SELECT * FROM test";
        // return $this->query($statement)->fetchAll();
        return $this->get("test")->fetchAll();
    }
    public function insertTest(array $data)
    {
        $this->insert("test", $data);
    }
    public function deleteTest(string $column, $value)
    {
        $this->delete("test", $column, $value);
    }
    public function deleteManyTest(array $columns, array $values, bool $use_and = true)
    {
        $this->deleteMany("test", $columns, $values, $use_and);
    }
    public function updateTest(array $update_column, array $update_value, string $where_column, $where_value)
    {
        $this->update("test", $update_column, $update_value, $where_column, $where_value);
    }
}
