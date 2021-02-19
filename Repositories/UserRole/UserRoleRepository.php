<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 6.12.2016 г.
 * Time: 10:08
 */

namespace Georgi\Repositories\UserRole;


use Georgi\Adapter\DatabaseInterface;
use Georgi\Repositories\AbstractRepository;

class UserRoleRepository extends AbstractRepository implements UserRoleRepositoryInterface
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
            'tableName' => 'user_role',
            'primaryKeyName' => 'id'
        ];
    }
}