<?php

namespace Payright\One;

use Payright\Client;
use Payright\Contracts\Authenticable;
use Payright\Message;
use Payright\Request;

class PaymentChannel extends Request
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
    public function all($collection)
    {

        $endpoint = $this->client->endpoint();

        $response = $this->client->httpClient()
            ->request('GET', $endpoint.'/v1/collections/'.$collection.'/channels', ['headers' => array_merge($this->client->auth()->credentials(),
                [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                ])]);

        return $this->responseWith($response);
    }

    /**
     * @return mixed
     */
    public function update($collection, $body)
    {

        $endpoint = $this->client->endpoint();

        $response = $this->client->httpClient()
            ->request('POST', $endpoint.'/v1/collections/'.$collection.'/channels', [
                'body' => json_encode($body),
                'headers' => array_merge($this->client->auth()->credentials(), [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                ])]);

        return $this->responseWith($response);
    }

}
