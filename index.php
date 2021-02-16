<?php
const DEFAULT_CONTROLLER = 'default';
const DEFAULT_ACTION = 'defaultAction';

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

\FPopov\Adapter\Database::setInstance(
    \FPopov\Config\DbConfig::DB_HOST,
    \FPopov\Config\DbConfig::DB_USER,
    \FPopov\Config\DbConfig::DB_PASS,
    \FPopov\Config\DbConfig::DB_NAME,
    $dbInstanceName
);