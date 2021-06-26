<?php

namespace App\Model;

use Sapling\Model\QueryBuilder as SaplingModel;

class TestModel extends SaplingModel
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAllTest()
    {
        $this->table("test");
        $this->order('test_id', false);
        return $this->get()->fetchAll();
    }
    public function insertTest(array $columns, array $data)
    {
        $this->table("test");
        $this->insert($columns, $data);
    }
    public function deleteTest(array $columns, array $values)
    {
        $this->table("test");
        $this->whereMany($columns, $values);
        $this->delete();
    }
    public function updateTest()
    {
        $this->table("test");
        $this->whereMany(['test_id'], [22]);
        $this->update(['name'], ['Angela']);
    }
}
