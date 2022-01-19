<?php

namespace Payright;

use Payright\Contracts\Authenticable;

class BearerAuth implements Authenticable
{
    /**
     * @var mixed
     */
    protected $client;

    /**
     * @param $config
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $config
     */
    public static function make(Client $client): self
    {
        return new self($client);
    }

    public function credentials(): array
    {
        return [
            'Authorization' => "Bearer ".$this->client->config()['api_key'],
        ];
    }

    /**
     * @return mixed
     */
    public function client(): Client
    {
        return $this->client;
    }

}
