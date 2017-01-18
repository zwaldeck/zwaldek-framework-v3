<?php

namespace Company\Plugins\FirstPlugin\Controller;

use Zwaldeck\Core\Controller\Controller;
use Zwaldeck\Core\Http\Response;

/**
 * Class HomeController
 * @package Company\Plugins\FirstPlugin\Controller
 */
class HomeController extends Controller
{
    public function welcomeAction($lastName, $firstName): ?Response {
        var_dump($lastName);
        var_dump($firstName);
        return null;
    }
}