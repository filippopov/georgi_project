<?php

namespace Georgi\Controllers;

use Georgi\Core\ViewInterface;
use Georgi\Services\Application\AuthenticationServiceInterface;
use Georgi\Services\Application\ResponseServiceInterface;
use Georgi\Core\MVC\MVCContext;
use Georgi\Services\Coment\ComentsServiceInterface;

class ComentsController 
{
    private $view;
    private $service;
    private $authenticationService;
    private $responseService;
    private $MVCContext;
    
    public function __construct(
        ViewInterface $view,
        AuthenticationServiceInterface $authenticationService,
        ResponseServiceInterface $responseService,
        MVCContext $MVCContext,
        ComentsServiceInterface $service) 
    {
        $this->view = $view;
        $this->authenticationService = $authenticationService;
        $this->responseService = $responseService;
        $this->MVCContext = $MVCContext;
        $this->service = $service;
    }
    
    public function coment($buisnesId)
    {
        if (!$this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect('users', 'login');
        }
        
        $clientId = $this->authenticationService->getUserId();
        
        $this->view->render();
    }
}
