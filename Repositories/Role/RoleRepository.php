<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 6.12.2016 г.
 * Time: 9:43
 */

namespace Georgi\Repositories\Role;


use Georgi\Adapter\DatabaseInterface;
use Georgi\Repositories\AbstractRepository;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    protected $db;

    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
        $this->db = $db;
    }

    public function setOptions()
    {
        return [
            'tableName' => 'roles',
            'primaryKeyName' => 'id'
        ];
    }
}