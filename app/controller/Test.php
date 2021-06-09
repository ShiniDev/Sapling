<?php

use Sapling\system\controller\Controller as Sapling_Controller;

defined("SAFE") or die("Direct access to scripts are not allowed.");

class Test extends Sapling_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load_model('Test_model');
    }
    public function index($data)
    {
        $this->load_view("index.php", $data);
    }
    public function table($data)
    {
        $data['table'] = $this->Test_model->get_all_test();
        $this->load_view("table.php", $data);
    }
    public function insert()
    {
        $this->Test_model->insert_test(['Mark', '09', 'PPC', 'PH']);
    }
    public function delete()
    {
        $this->Test_model->delete_test('test_id', 3);
    }
    public function delete_many()
    {
        $this->Test_model->delete_many_test(['test_id', 'test_id'], [2, 4], false);
    }
    public function update()
    {
        $this->Test_model->update_test(['language'], ['C++, PHP'], "test_id", 1);
    }
}
