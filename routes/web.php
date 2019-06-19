<?php

$router->get('/', [
    'as' => 'mainPage',
    'uses' => 'MainPageController@show'
]);

$router->post('/domains', [
    'as' => 'addDomain',
    'uses' => 'DomainsController@store'
]);

$router->get('/domains/{id}', [
    'as' => 'showDomain',
    'uses' => 'DomainsController@show'
]);

$router->get('/domains', [
    'as' => 'showDomains',
    'uses' => 'DomainsController@index'
]);
