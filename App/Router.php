<?php

$router = new \Core\Router();

/*$router->add('/' , 'HomeController@index');
$router->add('/series' , [ 'uses' => 'SeriesController@index' ] );
$router->add('/series/{slug}' , 'SeriesController@serie');
$router->add('/series/{slug}/episode/{id}' , 'SeriesController@episode');*/

$router->add('/' , 'HomeController@index');
$router->add('/register' , 'UserController@register');
$router->add('/registerStore' , 'UserController@store');
$router->add('/login' , 'AuthController@login');
$router->add('/auth' , 'AuthController@auth');
$router->add('/logout' , 'AuthController@logout');

return $router;
