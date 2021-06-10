<?php

namespace Sapling\app\controller;

use Sapling\system\controller\Controller as SaplingController;

class Test extends SaplingController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('TestModel');
    }
    public function index($data)
    {
        $this->loadView("index.php", $data);
    }
    public function table($data)
    {
        $data['table'] = $this->TestModel->getAllTest();
        $this->loadView("table.php", $data);
    }
    public function insert()
    {
        $this->TestModel->insertTest(['Mark', '09', 'PPC', 'PH']);
    }
    public function delete()
    {
        $this->TestModel->deleteTest('test_id', 3);
    }
    public function deleteMany()
    {
        $this->TestModel->deleteManyTest(['test_id', 'test_id'], [2, 4], false);
    }
    public function update()
    {
        $this->TestModel->updateTest(['language'], ['C++, PHP'], "test_id", 1);
    }
}
