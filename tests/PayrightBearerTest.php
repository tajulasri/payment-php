<?php

namespace Tests;

use Payright\BearerAuth;
use Payright\Client;
use Payright\Tests\TestCase;

class BearerAuthTest extends TestCase
{
    public function testItInstantiateClass()
    {
        $instance = new BearerAuth(Client::make($this->httpClientMock(), []));
        $viaStatic = BearerAuth::make(Client::make($this->httpClientMock(), []));

        $this->assertInstanceOf('Payright\BearerAuth', $instance);
        $this->assertInstanceOf('Payright\BearerAuth', $viaStatic);
    }

    public function testItReturnCorrectCredentials()
    {
        $data = 'test';

        $auth = BearerAuth::make(new Client($this->httpClientMock(), [
            'api_key' => $data,
        ]));

        $this->assertEquals(['Authorization' => "Bearer ".$data], $auth->credentials());
        $this->assertInstanceOf('Payright\Client', $auth->client());
    }
}
