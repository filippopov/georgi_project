<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Georgi\Models\View\User;

class UserRegistrationViewModel 
{
    private $roles;
    
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
    
    public function getRoles()
    {
        return $this->roles;
    }
}
