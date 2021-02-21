<?php

namespace Georgi\Repositories\Coment;

interface ComentsInterface 
{
    public function getComentsByBuisnesId($params = []);
    
    public function getComentsByClientId($params = []);
}