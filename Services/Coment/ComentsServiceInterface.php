<?php

namespace Georgi\Services\Coment;

interface ComentsServiceInterface 
{
    public function addComment($rating, $token, $buisnesId, $clientId);

    public function showComents($buisnesId, $clientId);
}
