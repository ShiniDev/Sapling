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
}
