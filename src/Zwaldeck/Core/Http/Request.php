<?php

namespace Zwaldeck\Core\Http;

/**
 * Class Request
 * @package Zwaldeck\Core\Http
 */
class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var ParameterMap
     */
    private $query;

    /**
     * @var ParameterMap
     */
    private $post;

    /**
     * @var ParameterMap
     */
    private $headers;

    //TODO implement file upload map
    private $files;

    /**
     * @var ParameterMap
     */
    private $cookies;

    /**
     * @var string
     */
    private $protocol;

    /**
     * @var string
     */
    private $requestURI;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->query = new ParameterMap($_GET);
        $this->post = new ParameterMap($_POST);
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if(substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        $this->headers = new ParameterMap($headers);
        $this->cookies = new ParameterMap($_COOKIE);
        //TODO Files

        $this->protocol = $_SERVER['SERVER_PROTOCOL'];
        $this->requestURI = $_SERVER['REQUEST_URI'];

        //empty global variables
        $_GET = [];
        $_POST = [];
        $_SERVER = [];
        $_COOKIE = [];
        $_FILES = [];
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return ParameterMap
     */
    public function getQuery(): ParameterMap
    {
        return $this->query;
    }

    /**
     * @return ParameterMap
     */
    public function getPost(): ParameterMap
    {
        return $this->post;
    }

    /**
     * @return ParameterMap
     */
    public function getHeaders(): ParameterMap
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return ParameterMap
     */
    public function getCookies(): ParameterMap
    {
        return $this->cookies;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @return string
     */
    public function getRequestURI(): string
    {
        return $this->requestURI;
    }

    /**
     * @return null|string
     */
    public function getHost() :?string {
        return $this->headers->getParameter('HTTP_HOST');
    }

    /**
     * @return bool
     */
    public function isSecure(): bool {
        return $this->headers->getParameter('REQUEST_SCHEME') === 'https';
    }


    public function isMethod(string $method): bool {
        //TODO make HTTP methods an ENUM
        return $this->method === strtoupper($method);
    }
}