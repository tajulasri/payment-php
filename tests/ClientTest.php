<?php

namespace Payright\Tests;

use Payright\Client;
use Psr\Http\Client\ClientInterface;

class ClientTest extends TestCase
{
    public function testItInstantiateMessage()
    {

        $apikey = 'test';

        $client = new Client($this->httpClientMock(), ['api_key' => $apikey, 'sandbox' => false]);
        $viaStatic = Client::make($this->httpClientMock(), ['api_key' => $apikey, 'sandbox' => false]);

        $this->assertInstanceOf('Payright\Client', $client);
        $this->assertInstanceOf('Payright\Client', $viaStatic);
        $this->assertInstanceOf(ClientInterface::class, $client->httpClient());

        $this->assertEquals(array_merge(['api_key' => $apikey, 'sandbox' => false]), $client->config());
    }
}
