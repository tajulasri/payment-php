<?php

namespace Tests\Feature;

use Payright\BearerAuth;
use Payright\Client;
use Payright\Tests\TestCase;

class CollectionResourceTest extends TestCase
{

    public function testItReturnCorrectCredentials()
    {
        $data = 'test';

        $client = new Client($this->httpClientMock(), [
            'api_key' => $data,
            'use_sandbox' => true,
        ]);

        $this->assertEquals(['Authorization' => "Bearer ".$data], $client->auth()->credentials());
        $this->assertInstanceOf('Payright\Client', $client);
    }
}
