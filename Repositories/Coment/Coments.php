<?php

namespace Georgi\Repositories\Coment;

use Georgi\Adapter\DatabaseInterface;
use Georgi\Repositories\AbstractRepository;

class Coments  extends AbstractRepository implements ComentsInterface
{
    protected $db;
    
    /**
     * UserRepository constructor.
     */
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
        $this->db = $db;
    }

    public function setOptions()
    {
        return [
            'tableName' => 'coments',
            'primaryKeyName' => 'id'
        ];
    }
}
