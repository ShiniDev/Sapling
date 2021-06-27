<?php

namespace App\Controller;

use Sapling\Controller\Controller as SaplingController;
use Sapling\Functions\Url;

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
        echo $this->TestModel->getLastQuery();
        $this->loadView("table.php", $data);
    }
    public function jointable($data)
    {
        $data['table'] = $this->TestModel->getAllHobby();
        echo $this->TestModel->getLastQuery();
        $this->loadView("jointable.php", $data);
    }
    public function insert($data)
    {
        $this->TestModel->insertTest(['test_id', 'hobby', 'birthday'], [$data[0], $data[1], $data[2]]);
        Url::redirect(Url::baseUrl() . "test/table");
    }
    public function delete($data)
    {
        $this->TestModel->deleteTest([$data[0]], [$data[1]]);
        Url::redirect(Url::baseUrl() . "test/table");
    }
    public function update()
    {
        $this->TestModel->updateTest();
        $this->TestModel->getLastQuery();
    }
}
