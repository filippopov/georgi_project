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
    
    public function getComentsByClientId($params = [])
    {
        $query = "
            SELECT 
                c.rating,
                uc.username AS client_ussername,
                ub.username AS busnes_username
            FROM coments AS c
            INNER JOIN users AS uc ON (c.client_user_id = uc.id)
            INNER JOIN users AS ub ON (c.business_user_id = ub.id)
            WHERE c.client_user_id = :clientId 
        ";
        
        $stmt = $this->db->prepare($query);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }
    
    public function getComentsByBuisnesId($params = [])
    {
        $query = "
            SELECT 
                c.rating,
                uc.username AS client_ussername,
                ub.username AS busnes_username
            FROM coments AS c
            INNER JOIN users AS uc ON (c.client_user_id = uc.id)
            INNER JOIN users AS ub ON (c.business_user_id = ub.id)
            WHERE c.business_user_id = :buisnesId
        ";
        
        $stmt = $this->db->prepare($query);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
