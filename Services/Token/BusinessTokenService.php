<?php

namespace Georgi\Services\Token;

use Georgi\Services\AbstractService;
use Georgi\Repositories\Token\BusinessTokenInterface;
use Georgi\Services\Application\EncryptionServiceInterface;
use Georgi\Core\MVC\Message;

class BusinessTokenService extends AbstractService  implements BusinessTokenServiceInterface
{
    private $businessTokenRepository;
    
    private $encryptionService;
    
    public function __construct(BusinessTokenInterface $businessTokenRepository, EncryptionServiceInterface $encryptionService) 
    {
        $this->businessTokenRepository = $businessTokenRepository;
        $this->encryptionService = $encryptionService;
    }
    
    public function generateToken($clientId, $businessId, $tokenOld)
    {
        $oldToken = $this->getToken($clientId, $businessId);
        if ($tokenOld || $oldToken){
            Message::postMessage('Token already created for this client!', Message::NEGATIVE_MESSAGE);
            return false;
        }

        $time = (new \DateTime())->format('Y-m-d H:i:s');
        
        $tokenBeforeHash = $businessId . '-' . $clientId . '-' . $time;

        $token = $this->encryptionService->hash($tokenBeforeHash);
        
        $createToken = $this->businessTokenRepository->create([
            'business_user_id' => $businessId,
            'client_user_id' => $clientId,
            'time' => $time,
            'token' => $token,
            'active' => 'yes'
        ]);
        
        if (!$createToken) {
            Message::postMessage('Token cannot be create!', Message::NEGATIVE_MESSAGE);
            return false;
        }
        
        Message::postMessage('Successfully create token!', Message::POSITIVE_MESSAGE);
        
        return true;
    }
    
    public function getToken($clientId, $businessId)
    {
        $token = '';
        
        $tokenData = $this->businessTokenRepository->findByCondition([
            'business_user_id' => $businessId,
            'client_user_id' => $clientId,
            'active' => 'yes'
        ]);
        
        if (!empty($tokenData))
        {
            $tokenData = isset($tokenData[0]) ? $tokenData[0] : array();
            $token = isset($tokenData['token']) ? $tokenData['token'] : '';
        }
        
        return $token;
    }
}
