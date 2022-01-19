<?php

namespace Payright\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Payright\Tests\HttpFaker;
use PHPUnit\Framework\TestCase as PHPUnit;
use Psr\Http\Client\ClientInterface;

class TestCase extends PHPUnit
{

    public function getApiKey(): string
    {
        return '4|DDFxDSyqgbZFBTJ13nfTljjAi4a96DH8fSxxyCgN';
    }

}
