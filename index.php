<?php

require 'bootstrap/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = require "App/Router.php";

(isset($_GET['url']))? $url=$_GET['url'] : $url='';

$router->dispatch($url);



