<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 28.11.2016 г.
 * Time: 20:37
 */

namespace Georgi\Models\View\User;


class UserProfileViewModel
{
    private $myUsername;
    
    private $otherUsers;
    
    private $role; 
    
    public function setMyUsername($username)
    {
        $this->myUsername = $username;
    }
    
    public function getMyUsername()
    {
        return $this->myUsername;
    }
    
    public function setOtherUsers($users)
    {
        $this->otherUsers = $users;
    }
    
    public function getOtherUsers()
    {
        return $this->otherUsers;
    }
    
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    public function getRole()
    {
        return $this->role;
    }
}