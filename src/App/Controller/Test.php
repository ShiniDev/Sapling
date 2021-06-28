<?php

namespace App\Controller;

use Sapling\Controller\Controller as SaplingController;

class Test extends SaplingController
{
    public function __construct()
    {
        parent::__construct();
        // $this->loadModel('TestModel');
    }
    public function index()
    {
        $this->loadView("index.php");
    }
}
