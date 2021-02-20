<?php

namespace Georgi\Services\Token;

interface BusinessTokenServiceInterface 
{
    public function generateToken($clientId, $businessId, $tokenOld);
    
    public function getToken($clientId, $businessId);
}
