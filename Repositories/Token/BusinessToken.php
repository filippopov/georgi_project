<?php

namespace Georgi\Repositories\Token;

use Georgi\Adapter\DatabaseInterface;
use Georgi\Repositories\AbstractRepository;

class BusinessToken extends AbstractRepository implements BusinessTokenInterface
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
            'tableName' => 'business_token',
            'primaryKeyName' => 'id'
        ];
    }
}
