<?php

namespace Georgi\Controllers;

use Georgi\Core\ViewInterface;
use Georgi\Services\User\UserServiceInterface;
use Georgi\Services\Application\AuthenticationServiceInterface;
use Georgi\Services\Application\ResponseServiceInterface;
use Georgi\Core\MVC\MVCContext;
use Georgi\Models\Binding\User\UserRegisterBindingModel;
use Georgi\Models\View\User\UserRegistrationViewModel;
use Georgi\Models\Binding\User\UserLoginBindingModel;
use Georgi\Models\View\User\UserProfileViewModel;

class UsersController 
{
    const BUSINESS_ROLE_ID = 1;
    const CLIENT_ROLE_ID = 2;
    
    private $view;
    private $service;
    private $authenticationService;
    private $responseService;
    private $MVCContext;
    
    public function __construct(
        ViewInterface $view,
        UserServiceInterface $service,
        AuthenticationServiceInterface $authenticationService,
        ResponseServiceInterface $responseService,
        MVCContext $MVCContext) 
    {
            $this->view = $view;
            $this->service = $service;
            $this->authenticationService = $authenticationService;
            $this->responseService = $responseService;
            $this->MVCContext = $MVCContext;
                 
    }
    
    public function login()
    {
        if ($this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect('users', 'profile');
        }
        
        $this->view->render();
    }
    
    public function loginPost(UserLoginBindingModel $bindingModel)
    {
        $username = $bindingModel->getUsername();
        $password = $bindingModel->getPassword();

        $loginResult = $this->authenticationService->login($username, $password);

        if ($loginResult) {
            $this->responseService->redirect('users', 'profile');
            exit();
        }

        $this->responseService->redirect('users', 'login');
        exit();
    }
    
    public function registration()
    {
        if ($this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect('users', 'profile');
        }
        
        $userRoles = $this->service->findUserRoles();
        
        $userModel = new UserRegistrationViewModel();
        $userModel->setRoles($userRoles);
        
        $this->view->render(['model' => $userModel]);
    }
    
    public function registerPost(UserRegisterBindingModel $bindingModel)
    {
        $username = $bindingModel->getUsername();
        $password = $bindingModel->getPassword();
        $role = $bindingModel->getRole();

        $registerResult = $this->service->register($username, $password, $role);
        
        if ($registerResult) {
            $this->responseService->redirect('users', 'profile');
            exit();
        }
        
        $this->responseService->redirect('users', 'registration');
        exit();
    }
    
    public function logout()
    {
        $this->authenticationService->logout();
        $this->responseService->redirect('users', 'login');
    }

    public function profile()
    {
        if (!$this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect('users', 'login');
        }
        
        $userId = $this->authenticationService->getUserId();
        
        $user = $this->service->getUserWithRole($userId);
        $username = isset($user['username']) ? $user['username'] : '';
        
        $userRole = isset($user['role_name']) ? $user['role_name'] : '';
        
        $lookingForRole = '';
        switch ($userRole){
            case 'business':
                $lookingForRole = self::CLIENT_ROLE_ID;
                break;
            case 'client':
                $lookingForRole = self::BUSINESS_ROLE_ID;
                break;
        }
        
        $getAllUsers = $this->service->getUserByRole($lookingForRole);
        
        $userProfileViewModel = new UserProfileViewModel();
        $userProfileViewModel->setMyUsername($username);
        $userProfileViewModel->setOtherUsers($getAllUsers);
        $userProfileViewModel->setRole($userRole);

        $this->view->render(['model' => $userProfileViewModel]);
    }
}
