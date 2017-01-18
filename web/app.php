<?php

use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Kernel\AutoLoader;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ ."/../src/Zwaldeck/Core/Kernel/AutoLoader.php";
$autoLoader = new AutoLoader();

require_once __DIR__ ."/../app/UserKernel.php";
$kernel = new UserKernel($autoLoader->getRootDir(), "dev", true);
$kernel->boot();

$request = new Request();
$response =  $kernel->handleRequest($request);
$response->send();