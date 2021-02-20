<?php

namespace Georgi\Services\Coment;

interface ComentsServiceInterface 
{
    public function createComent($buisnesId, $clientId);

    public function showComents($buisnesId, $clientId);
}
