<?php

namespace Georgi\Controllers;

use Georgi\Core\ViewInterface;
use Georgi\Services\Application\AuthenticationServiceInterface;
use Georgi\Services\Application\ResponseServiceInterface;
use Georgi\Core\MVC\MVCContext;
use Georgi\Models\Binding\Token\GenerateTokenBindingModel;
use Georgi\Models\View\Token\TokenViewModel;
use Georgi\Services\Token\BusinessTokenServiceInterface;

class TokenController 
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
        BusinessTokenServiceInterface $service) 
    {
        $this->view = $view;
        $this->authenticationService = $authenticationService;
        $this->responseService = $responseService;
        $this->MVCContext = $MVCContext;
        $this->service = $service;
    }
    
    public function generateToken($clientId)
    {
        if (!$this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect('users', 'login');
        }
        
        $businessId = $this->authenticationService->getUserId();
        
        $token = $this->service->getToken($clientId, $businessId);
        $tokenViewModel = new TokenViewModel();
        $tokenViewModel->setClientId($clientId);
        $tokenViewModel->setToken($token);
        
        $this->view->render(['model' => $tokenViewModel]);
    }
    
    public function generateTokenPost(GenerateTokenBindingModel $bindingModel)
    {
        if (!$this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect('users', 'login');
        }
        
        $clientId = $bindingModel->getClientId();
        $token = $bindingModel->getToken();

        $businessId = $this->authenticationService->getUserId();
        
        $this->service->generateToken($clientId, $businessId, $token);

        $this->responseService->redirect('token', 'generateToken', [$clientId]);
    }
}
