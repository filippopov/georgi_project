<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 29.11.2016 г.
 * Time: 14:21
 */

namespace Georgi\Repositories\User;


use Georgi\Adapter\DatabaseInterface;
use Georgi\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
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
            'tableName' => 'users',
            'primaryKeyName' => 'id'
        ];
    }
    
    public function getUserWithRole($params = [])
    {
        $query = "
            SELECT 
                u.id,
                u.username,
                u.role_id,
                r.name AS role_name
            FROM users AS u
            INNER JOIN roles AS r ON (r.id = u.role_id)
            WHERE u.id = :userId;
            LIMIT 1
        ";
        
        $stmt = $this->db->prepare($query);

        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function getUserByRole($params = [])
    {
        $query = "
            SELECT 
                u.id,
                u.username,
                r.name AS role_name
            FROM users AS u 
            INNER JOIN roles AS r ON (r.id = u.role_id)
            WHERE r.id = :roleId;
        ";
        
        $stmt = $this->db->prepare($query);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}