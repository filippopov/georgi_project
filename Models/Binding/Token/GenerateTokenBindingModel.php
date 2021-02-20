<?php

namespace Georgi\Models\Binding\Token;

class GenerateTokenBindingModel 
{
    private $token;
    private $clientId;


    public function getToken()
    {
        return $this->token;
    }
    
    public function setToken($token)
    {
        $this->token = $token;
    }
    
    public function getClientId()
    {
        return $this->clientId;
    }
    
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }
    
    
}
