<?php

namespace Georgi\Models\Binding\Comment;

class AddCommentBindingModel 
{
    private $buisnesId;
    private $token;
    private $rating;

    public function getToken()
    {
        return $this->token;
    }
    
    public function setToken($token)
    {
        $this->token = $token;
    }
    
    public function getBuisnesId()
    {
        return $this->buisnesId;
    }
    
    public function setBuisnesId($buisnesId)
    {
        $this->buisnesId = $buisnesId;
    }
    
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
    
    public function getRating()
    {
        return $this->rating;
    }
}
