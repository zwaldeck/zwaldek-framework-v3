<?php

namespace Company\Plugins\FirstPlugin\Controller;

use Zwaldeck\Core\Controller\Controller;
use Zwaldeck\Core\Http\Response;

/**
 * Class TestController
 * @package Company\Plugins\FirstPlugin\Controller
 */
class TestController extends Controller
{
    public function testAction(): ?Response {
        $response = new Response($this->request);
        $response->setContent("<h1>This is a test action</h1>");

        return $response;
    }
}