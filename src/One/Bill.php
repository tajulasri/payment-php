<?php

namespace Payright\One;

use Payright\Client;
use Payright\Contracts\Authenticable;
use Payright\Message;
use Payright\Request;

class Bill extends Request
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
    public function all()
    {

        $endpoint = $this->client->endpoint();

        $response = $this->client->httpClient()
            ->request('GET', $endpoint.'/v1/bills', ['headers' => array_merge($this->client->auth()->credentials(),
                [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                ])]);

        return $this->responseWith($response);
    }

    /**
     * @return mixed
     */
    public function create($data = [])
    {

        $endpoint = $this->client->endpoint();

        $body = $this->mergeApiBody(
            array_merge(
                $data
            )
        );

        $response = $this->client->httpClient()
            ->request('POST', $endpoint.'/v1/bills', [
                'body' => json_encode($body),
                'headers' => array_merge(
                    $this->client->auth()->credentials(),
                    [
                        'Accept' => 'application/json',
                        'Content-type' => 'application/json',
                    ]
                ),
            ]);

        return $this->responseWith($response);
    }

    /**
     * @return mixed
     */
    public function get($id)
    {

        $endpoint = $this->client->endpoint();

        $response = $this->client->httpClient()
            ->request('GET', $endpoint.'/v1/bills/'.$id);

        return $this->responseWith($response);
    }

    /**
     * @return mixed
     */
    public function update($id, $data = [])
    {

        $endpoint = $this->client->endpoint();

        $body = $this->mergeApiBody(
            array_merge(
                $data
            )
        );

        $response = $this->client->httpClient()
            ->request('PUT', $endpoint.'/v1/bills/'.$id, [
                'form_params' => $body,
                'headers' => array_merge(
                    $this->client->auth()->credentials()
                ),
            ]);

        return $this->responseWith($response);
    }

    /**
     * @return mixed
     */
    public function delete($id)
    {

        $endpoint = $this->client->endpoint();

        $response = $this->client->httpClient()
            ->request('DELETE', $endpoint.'/v1/collections/'.$id);

        return $this->responseWith($response);
    }

}
