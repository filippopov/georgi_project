<?php

namespace Georgi\Services\Coment;

use Georgi\Services\AbstractService;
use Georgi\Core\MVC\Message;
use Georgi\Repositories\Coment\ComentsInterface;
use Georgi\Services\Application\EncryptionServiceInterface;
use Georgi\Repositories\Token\BusinessTokenInterface;

class ComentsService extends AbstractService  implements ComentsServiceInterface
{
    private $commentsRepository;
    
    private $encryptionService;
    
    private $businessTokenRepository;
    
    public function __construct(ComentsInterface $commentsRepository, EncryptionServiceInterface $encryptionService, BusinessTokenInterface $businessTokenRepository) 
    {
        $this->commentsRepository = $commentsRepository;
        $this->encryptionService = $encryptionService;
        $this->businessTokenRepository = $businessTokenRepository;
    }

    public function addComment($rating, $token, $buisnesId, $clientId)
    {
        if (!$rating || !$token || !$buisnesId || !$clientId)
        {
            Message::postMessage('Invalid data, comment cannot be created!', Message::NEGATIVE_MESSAGE);
            return false;
        }
        
        $tokenData = $this->businessTokenRepository->findByCondition(['business_user_id' => $buisnesId, 'client_user_id' => $clientId, 'token' => $token]);

        if (empty($tokenData)){
            Message::postMessage('System cannot find the token!', Message::NEGATIVE_MESSAGE);
            return false;
        }
        
        $tokenData = isset($tokenData[0]) ? $tokenData[0] : array();
        
        $isActive = isset($tokenData['active']) ? $tokenData['active'] : 'No';

        if ($isActive == 'No'){
            Message::postMessage('This token is used already!', Message::NEGATIVE_MESSAGE);
            return false;
        }
        
        $time = isset($tokenData['time']) ? $tokenData['time'] : '';
        $tokenHash = isset($tokenData['token']) ? $tokenData['token'] : '';
        
        if (!$time) {
            Message::postMessage('Invalid time!', Message::NEGATIVE_MESSAGE);
            return false;
        }
        
        $tokenValue = $buisnesId . '-' . $clientId . '-' . $time;
        
        if (!$this->encryptionService->verify($tokenValue, $tokenHash)) {
            Message::postMessage('Invalid token!', Message::NEGATIVE_MESSAGE);
            return false;
        }
        
        $createComment = $this->commentsRepository->create([
            'rating' => $rating,
            'client_user_id' => $clientId,
            'business_user_id' => $buisnesId,
            'token' => $token
        ]);
        
        if (!$createComment){
            Message::postMessage('Comment cannot be created!', Message::NEGATIVE_MESSAGE);
            return false;
        }
        
        $busnesTokenId = isset($tokenData['id']) ? $tokenData['id'] : 0;
        
        $this->businessTokenRepository->update($busnesTokenId, ['active' => 'No']);
        
        Message::postMessage('Successfully create comment!', Message::POSITIVE_MESSAGE);
    }
}
