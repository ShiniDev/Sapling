<?php

namespace App\Model;

use Sapling\Model\QueryBuilder as SaplingModel;

class TestModel extends SaplingModel
{
    public function __construct()
    {
        parent::__construct();
    }
    public function sampleGet()
    {
        $this->table('table');
        // Below shows how to set the where clause
        // All three does the same thing
        $this->whereManual("WHERE column = ? AND column1 = ?", [0, 1]);
        // or
        $this->whereSpecific('column', 0, "=");
        $this->whereSpecific('column1', 1, "=");
        // or
        $this->whereMany(['column', 'column1'], [0, 1]);
        // Example join
        $this->join('left', 'test', 'table.id = test.id');
        // Example ordering
        $this->order('column');
        // Example limit
        $this->limit(100);
        // Example get 
        return $this->get()->fetchAll();
    }
    public function sampleSelect()
    {
        $this->table('table');
        // Below shows how to set the where clause
        // All three does the same thing
        $this->whereManual("WHERE column = ? AND column1 = ?", [0, 1]);
        // or
        $this->whereSpecific('column', 0, "=");
        $this->whereSpecific('column1', 1, "=");
        // or
        $this->whereMany(['column', 'column1'], [0, 1]);
        // Example join
        $this->join('left', 'test', 'table.id = test.id');
        // Example ordering
        $this->order('column');
        // Example limit
        $this->limit(100);
        // Example select
        return $this->select(['column', 'column1'])->fetchAll();
    }
    public function sampleInsert()
    {
        $this->table('table');
        $this->insert(['columns'], [0]);
    }
    public function sampleUpdate()
    {
        $this->table('table');
        // Below shows how to set the where clause
        // All three does the same thing
        $this->whereManual("WHERE column = ? AND column1 = ?", [0, 1]);
        // or
        $this->whereSpecific('column', 0, "=");
        $this->whereSpecific('column1', 1, "=");
        // or
        $this->whereMany(['column', 'column1'], [0, 1]);
        $this->update(['column', 'column1'], [1, 0]);
    }
    public function sampleDelete()
    {
        $this->table('table');
        // Below shows how to set the where clause
        // All three does the same thing
        $this->whereManual("WHERE column = ? AND column1 = ?", [0, 1]);
        // or
        $this->whereSpecific('column', 0, "=");
        $this->whereSpecific('column1', 1, "=");
        // or
        $this->whereMany(['column', 'column1'], [0, 1]);
        $this->delete();
    }
}
