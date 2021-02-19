<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 28.11.2016 г.
 * Time: 19:41
 */

namespace Georgi\Services\Application;


interface ResponseServiceInterface
{
    public function redirect($controller, $action, $params = []);
}