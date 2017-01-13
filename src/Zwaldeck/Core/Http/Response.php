<?php

namespace Zwaldeck\Core\Http;

/**
 * Class Response
 * @package Zwaldeck\Core\Http
 */
class Response
{
    public static $statusTexts = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Reserved',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',                                               // RFC2324
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Reserved for WebDAV advanced collections expired proposal',   // RFC2817
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates (Experimental)',                      // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    );

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ParameterMap
     */
    private $headers;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $httpVersion;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $statusText;

    //todo implement cookies
    public function __construct(Request $request, $content = "", $statusCode = 200, $headers = [], $cookies = [])
    {
        $this->request = $request;
        $this->headers = new ParameterMap($headers);
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->setStatusText();

        //TODO expand to HTTP2
        if ($request->getProtocol() === 'HTTP/1.1') {
            $this->httpVersion = "1.1";
        } else {
            $this->httpVersion = "1.0";
        }
    }

    /**
     * @return array
     */
    public static function getStatusTexts(): array
    {
        return self::$statusTexts;
    }

    /**
     * @param array $statusTexts
     */
    public static function setStatusTexts(array $statusTexts)
    {
        self::$statusTexts = $statusTexts;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return ParameterMap
     */
    public function getHeaders(): ParameterMap
    {
        return $this->headers;
    }

    /**
     * @param ParameterMap $headers
     */
    public function setHeaders(ParameterMap $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addHeader(string $name, string $value): void {
        $this->headers->addParameter($name, $value);
    }

    public function addHeaders(array $headers): void {
        foreach ($headers as $name => $value) {
            $this->addHeader($name, $value);
        }
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getHttpVersion(): string
    {
        return $this->httpVersion;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        $this->setStatusText();
    }

    /**
     * @return string
     */
    public function getStatusText(): string
    {
        return $this->statusText;
    }


    public function send() :void{
        $this->prepare();
        $this->addAllCookies();
        $this->sendAllHeaders();

        echo $this->content;
    }

    private function setStatusText()
    {
        if (!array_key_exists($this->statusCode, self::$statusTexts)) {
            throw new \InvalidArgumentException("There is no http status code for '{$this->statusCode}'!");
        }

        $this->statusText = self::$statusTexts[$this->statusCode];
    }

    private function prepare(): void {
        if(!$this->headers->has('Content-Type')) {
            $this->headers->addParameter('Content-Type', 'text/html');
        }

        if(!$this->headers->has('Content-Length')) {
            $this->headers->addParameter('Content-Length', strlen($this->content));
        }
    }

    private function addAllCookies(): void {
        //TODO implement
    }

    private function sendAllHeaders(): void {
        if(!headers_sent()) {
            header("HTTP/{$this->httpVersion} {$this->statusCode} {$this->statusText}", true, $this->statusCode);
            foreach ($this->headers as $name => $value) {
                header($name.': '.$value, false, $this->statusCode);
            }
        }
    }
}