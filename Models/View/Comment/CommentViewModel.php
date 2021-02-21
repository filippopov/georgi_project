<?php

namespace Georgi\Models\View\Comment;

class CommentViewModel 
{
    private $buisnesId;
    
    public function getBuisnesId()
    {
        return $this->buisnesId;
    }
    
    public function setBuisnesId($buisnesId)
    {
        $this->buisnesId = $buisnesId;
    }
}
