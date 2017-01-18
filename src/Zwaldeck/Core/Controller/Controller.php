<?php

namespace Zwaldeck\Core\Controller;


use Zwaldeck\Core\DependencyInjection\ContainerAware;
use Zwaldeck\Core\Http\Request;

abstract class Controller extends ContainerAware
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}