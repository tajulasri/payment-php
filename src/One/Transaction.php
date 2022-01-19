<?php

namespace Payright\One;

use Payright\Client;
use Payright\Contracts\Authenticable;
use Payright\Message;
use Payright\Request;

class Transaction extends Request
{
    /**
     * @var mixed
     */
    protected $client;

    /**
     * @param data $data
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param data $data
     */
    public static function make(Client $client)
    {
        return new self($client);
    }

    /**
     * @return mixed
     */
    public function all($bill)
    {

        $endpoint = $this->client->endpoint();

        $response = $this->client->httpClient()
            ->request('GET', $endpoint.'/v1/bills/'.$bill.'/transactions', ['headers' => array_merge($this->client->auth()->credentials(),
                [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                ])]);

        return $this->responseWith($response);
    }

}
