<?php

$router->get('/', [
    'as' => 'mainPage',
    'uses' => 'DomainsController@showMainPage'
]);
$router->post('/domains', [
    'as' => 'addDomain',
    'uses' => 'DomainsController@addDomain'
]);

$router->get('/domains/{id}', [
    'as' => 'showDomain',
    'uses' => 'DomainsController@showDomain'
]);
