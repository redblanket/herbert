<?php

// $router = Herbert\Framework\Router

$router->get([
    'uri' => '/herbert',
    'uses' => function (Herbert\Framework\Application $app)
    {
        return "Herbert v{$app->version()} {$app->environment()}";
    }
]);
