<?php

use Shini\system\model\Model as Shini_Model;

class Test_model extends Shini_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_test(): array|bool
    {
        $statement = "SELECT * FROM test";
        return $this->query($statement)->fetchAll();
    }
}
