<?php

namespace Georgi\Controllers;

use Georgi\Core\ViewInterface;
use Georgi\Services\User\UserServiceInterface;
use Georgi\Services\Application\AuthenticationServiceInterface;
use Georgi\Services\Application\ResponseServiceInterface;
use Georgi\Core\MVC\MVCContext;


class UsersController 
{
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
        $this->view->render();
    }
}
