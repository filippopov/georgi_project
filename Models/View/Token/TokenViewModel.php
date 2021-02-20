<?php

namespace Georgi\Models\View\Token;

class TokenViewModel 
{
    private $clientId;
    private $token;
    
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
