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
    public function register($username, $password) : bool;

    public function findOne($id) : User;

    public function edit(UserProfileEditBindingModel $bindingModel);

}