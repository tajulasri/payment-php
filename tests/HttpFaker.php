<?php

namespace Payright\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class HttpFaker
{
    /**
     * @var mixed
     */
    protected $client;

    /**
     * @var mixed
     */
    protected $endpoint;

    /**
     * @var mixed
     */
    protected $expectedJsonResponse;

    /**
     * @var mixed
     */
    protected $expectedResponseHeaders = [];

    /**
     * @var mixed
     */
    protected $mock;

    public function __construct()
    {

    }

    public static function create(): self
    {
        return new static();
    }

    /**
     * @return mixed
     */
    public function shouldHeaderResponse(): array
    {
        return $this->expectedResponseHeaders;
    }

    /**
     * @param int     $status
     * @param array   $headers
     * @param $body
     */
    public function shouldResponse(int $status = 200, $headers = [], $body = ''): Response
    {
        $body = \is_array($body) ? json_encode($body) : $body;

        return $this->mock->append(new Response($status, $headers, $body));
    }

    /**
     * @param int    $status
     * @param array  $headers
     * @param string $body
     */
    public function shouldResponseJson(int $status = 200, $headers = [],  ? string $body = '') : self
    {
        $body = \is_array($body) ? json_encode($body) : $body;
        $headers = array_merge($headers, ['Content-type' => 'application/json']);

        $this->expectedJsonResponse = new Response($status, $headers, $body);
        return $this;

    }

    /**
     * @return mixed
     */
    public function expectedJsonResponse(): Response
    {
        return $this->expectedJsonResponse;
    }

    public function faker(): ClientInterface
    {

        $handlerStack = HandlerStack::create(new MockHandler([
            $this->expectedJsonResponse(),
        ]));

        return new Client(['handler' => $handlerStack]);
    }
}
