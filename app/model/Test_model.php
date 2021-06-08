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
        $statement = "SELECT * FROM test";
        return $this->query($statement)->fetchAll();
    }
}
