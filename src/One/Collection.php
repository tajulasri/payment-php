<?php

namespace Payright\One;

use Payright\Client;
use Payright\Contracts\Authenticable;
use Payright\Message;
use Payright\Request;

class Collection extends Request
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
            ->get($endpoint.'/v1/collections');

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
            ->post($endpoint.'/v1/collections', [
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
    public function get($id)
    {

        $endpoint = $this->client->endpoint();

        $response = $this->client->httpClient()
            ->get($endpoint.'/v1/collections/'.$id);

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
            ->put($endpoint.'/v1/collections/'.$id, [
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
            ->delete($endpoint.'/v1/collections/'.$id);

        return $this->responseWith($response);
    }

}
