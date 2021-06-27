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
        $this->order('name');
        $this->whereSpecific("test_id", 20, "<");
        $this->limit(100, 1);
        return $this->get()->fetchAll();
    }
    public function getAllHobby()
    {
        $this->table("test");
        $this->join("inner", "hobbies", "test.test_id = hobbies.test_id");
        return $this->select(['test.name', 'hobbies.hobby'], false)->fetchAll();
    }
    public function insertTest(array $columns, array $data)
    {
        $this->table("hobbies");
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
