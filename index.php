<?php
const DEFAULT_CONTROLLER = 'users';
const DEFAULT_ACTION = 'login';

include 'autoloader.php';
include 'helper.php';

session_start();

$uri = $_SERVER['REQUEST_URI'];
$self = $_SERVER['PHP_SELF'];

$self = str_replace('index.php', '', $self);

if ($self != '/') {
    $uri = str_replace($self, '', $uri);
} else {
    $uri = substr($uri, 1);
}

$getParams = explode('?', $uri);

$uri = array_shift($getParams);

if(! empty($getParams)) {
    $getParams = $getParams[0];
    $getParams = explode('&', $getParams);
    foreach ($getParams as $key => $value) {
        parse_str($value, $arr);
        unset($getParams[$key]);
        $getParams[$key] = $arr;
    }
}

foreach ($getParams as $key => $value) {
    if (is_array($value)) {
        $temporaryKey = key($value);
        if (key_exists($temporaryKey, $getParams)) {
            $secondKey = key($value[$temporaryKey]);
            if (key_exists($secondKey, $getParams[$temporaryKey])) {
                $takeKey = key($value[$temporaryKey][$secondKey]);
                $getParams[$temporaryKey][$secondKey][$takeKey] = $value[$temporaryKey][$secondKey][$takeKey];
            } else {
                $getParams[$temporaryKey][$secondKey] = $value[$temporaryKey][$secondKey];
            }
        } else {
            $getParams[$temporaryKey] = $value[$temporaryKey];
        }
    }
    unset($getParams[$key]);
}

$args = explode('/', $uri);

$controllerName = array_shift($args);

$actionName = array_shift($args);

$dbInstanceName = 'default';

\Georgi\Adapter\Database::setInstance(
    \Georgi\Config\DbConfig::DB_HOST,
    \Georgi\Config\DbConfig::DB_USER,
    \Georgi\Config\DbConfig::DB_PASS,
    \Georgi\Config\DbConfig::DB_NAME,
    $dbInstanceName
);

if (empty($controllerName) && empty($actionName)) {
    $controllerName = DEFAULT_CONTROLLER;
    $actionName = DEFAULT_ACTION;
}

$mvcContext = new \Georgi\Core\MVC\MVCContext($controllerName, $actionName, $self, $args, $getParams);

$app = new \Georgi\Core\Application($mvcContext);

$app->addClass(\Georgi\Core\MVC\MVCContext::class, $mvcContext);
$app->addClass(\Georgi\Adapter\DatabaseInterface::class, \Georgi\Adapter\Database::getInstance($dbInstanceName));
$app->addClass(\Georgi\Core\MVC\SessionInterface::class, new \Georgi\Core\MVC\Session($_SESSION));

$app->registerDependency(\Georgi\Core\ViewInterface::class, \Georgi\Core\View::class);
$app->registerDependency(\Georgi\Services\User\UserServiceInterface::class, \Georgi\Services\User\UserService::class);
$app->registerDependency(\Georgi\Services\Application\EncryptionServiceInterface::class, \Georgi\Services\Application\BCryptEncryptionService::class);
$app->registerDependency(\Georgi\Services\Application\AuthenticationServiceInterface::class, \Georgi\Services\Application\AuthenticationService::class);
$app->registerDependency(\Georgi\Services\Application\ResponseServiceInterface::class, \Georgi\Services\Application\ResponseService::class);
$app->registerDependency(\Georgi\Repositories\User\UserRepositoryInterface::class, \Georgi\Repositories\User\UserRepository::class);
$app->registerDependency(\Georgi\Repositories\Role\RoleRepositoryInterface::class, \Georgi\Repositories\Role\RoleRepository::class);
$app->registerDependency(\Georgi\Repositories\UserRole\UserRoleRepositoryInterface::class, \Georgi\Repositories\UserRole\UserRoleRepository::class);
$app->registerDependency(\Georgi\Repositories\Token\BusinessTokenInterface::class, \Georgi\Repositories\Token\BusinessToken::class);
$app->registerDependency(\Georgi\Services\Token\BusinessTokenServiceInterface::class, \Georgi\Services\Token\BusinessTokenService::class);
$app->registerDependency(\Georgi\Repositories\Coment\ComentsInterface::class, \Georgi\Repositories\Coment\Coments::class);
$app->registerDependency(\Georgi\Services\Coment\ComentsServiceInterface::class, \Georgi\Services\Coment\ComentsService::class);

$app->start();