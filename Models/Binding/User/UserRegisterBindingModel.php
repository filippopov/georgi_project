<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 26.11.2016 г.
 * Time: 22:58
 */

namespace Georgi\Models\Binding\User;


class UserRegisterBindingModel
{
    private $username;

    private $password;
    
    private $role;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $password
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
}