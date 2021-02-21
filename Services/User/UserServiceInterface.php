<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 27.11.2016 г.
 * Time: 11:00
 */

namespace Georgi\Services\User;


use Georgi\Models\Binding\User\UserProfileEditBindingModel;
use Georgi\Models\DB\User\User;

interface UserServiceInterface
{
    public function register($username, $password, $role) : bool;

    public function findOne($id) : User;

    public function edit(UserProfileEditBindingModel $bindingModel);
    
    public function findUserRoles();
    
    public function getUserWithRole($userId);
    
    public function getUserByRole($roleId);
            
    public function getYourComments($userId);
    
    public function getForYouComments($userId);
}