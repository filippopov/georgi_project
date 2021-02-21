<?php

namespace Georgi\Controllers;

use Georgi\Core\ViewInterface;
use Georgi\Services\Application\AuthenticationServiceInterface;
use Georgi\Services\Application\ResponseServiceInterface;
use Georgi\Core\MVC\MVCContext;
use Georgi\Services\Coment\ComentsServiceInterface;
use Georgi\Models\Binding\Comment\AddCommentBindingModel;
use Georgi\Models\View\Comment\CommentViewModel;

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
        
        $commentViewModel = new CommentViewModel();
        $commentViewModel->setBuisnesId($buisnesId);
        
        $this->view->render(['model' => $commentViewModel]);
    }
    
    public function comentPost(AddCommentBindingModel $bindingModel)
    {
        if (!$this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect('users', 'login');
        }
        
        $buisnesId = $bindingModel->getBuisnesId();
        $token = $bindingModel->getToken();
        $rating = $bindingModel->getRating();
        $clientId = $this->authenticationService->getUserId();
        
        $this->service->addComment($rating, $token, $buisnesId, $clientId);
        
        $this->responseService->redirect('users', 'profile');
    }
}
