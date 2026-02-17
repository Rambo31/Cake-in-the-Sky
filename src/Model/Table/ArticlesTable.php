<?php
// src/Model/Table/ArticlesTable.php
declare(strict_types=1); //strict typed arguments

namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp'); //populate created and modified DATETIME fields
    }
}
