<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 25.11.2016 г.
 * Time: 21:26
 */

namespace Georgi\Services\User;


use Georgi\Adapter\DatabaseInterface;
use Georgi\Core\MVC\Message;
use Georgi\Core\ViewInterface;
use Georgi\Models\Binding\User\UserProfileEditBindingModel;
use Georgi\Models\DB\Role\Role;
use Georgi\Models\DB\User\User;
use Georgi\Repositories\Role\RoleRepository;
use Georgi\Repositories\Role\RoleRepositoryInterface;
use Georgi\Repositories\User\UserRepository;
use Georgi\Repositories\User\UserRepositoryInterface;
use Georgi\Repositories\UserRole\UserRoleRepository;
use Georgi\Repositories\UserRole\UserRoleRepositoryInterface;
use Georgi\Services\AbstractService;
use Georgi\Services\Application\EncryptionServiceInterface;

class UserService extends AbstractService  implements UserServiceInterface
{
    const IS_ACTIVE = 1;
    const USER_ROLE = 'user';

    private $db;
    private $encryptionService;
    private $view;

    /** @var  UserRepository */
    private $userRepository;

    /** @var RoleRepository */
    private $roleRepository;
    /** @var  UserRoleRepository */
    private $userRoleRepository;

    public function __construct(
        DatabaseInterface $db,
        EncryptionServiceInterface $encryptionService,
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository,
        UserRoleRepositoryInterface $userRoleRepository,
        ViewInterface $view)
    {
        $this->db = $db;
        $this->encryptionService = $encryptionService;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->view = $view;
    }

    public function register($username, $password) : bool
    {
        if (strlen($username) < 5) {
            Message::postMessage('Username must be, at least five or more symbols', Message::NEGATIVE_MESSAGE);
            return false;
        }

        if (strlen($password) < 5) {
            Message::postMessage('Password must be, at least five or more symbols', Message::NEGATIVE_MESSAGE);
            return false;
        }

        $isExistUsername = $this->userRepository->findByCondition(['username' => $username]);

        if (! empty($isExistUsername)) {
            Message::postMessage('Username exist', Message::NEGATIVE_MESSAGE);
            return false;
        }

        $userRegister = $this->userRepository->create([
            'username' => $username,
            'password' => $this->encryptionService->hash($password),
            'is_active' => self::IS_ACTIVE
        ]);

        /** @var User[] $user */
        $user = $this->userRepository->findByCondition(['username' => $username], User::class);

        /** @var Role[] $role */
        $role = $this->roleRepository->findByCondition(['name' => self::USER_ROLE], Role::class);

        $userRole = $this->userRoleRepository->create([
            'user_id' => $user[0]->getId(),
            'role_id' => $role[0]->getId()
        ]);

        if ($userRegister && $userRole) {
            Message::postMessage('Successfully register user', Message::POSITIVE_MESSAGE);
        } else {
            Message::postMessage('Please try again', Message::NEGATIVE_MESSAGE);
            return false;
        }

        return true;
    }

    public function findOne($id) : User
    {
        /** @var User $user */
        $user = $this->userRepository->findOneRowById($id, User::class);

        return $user;
    }

    public function edit(UserProfileEditBindingModel $bindingModel)
    {
        if ($bindingModel->getPassword() != $bindingModel->getConfirmPassword()) {
            return false;
        }

        $params = [
            'username' => $bindingModel->getUsername(),
            'password' => $this->encryptionService->hash($bindingModel->getPassword()),
            'email' => $bindingModel->getEmail(),
            'birthday' => $bindingModel->getBirthday(),
        ];

        return $this->userRepository->update($bindingModel->getId(), $params);
    }
}