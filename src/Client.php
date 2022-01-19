<?php

namespace Payright;

use Psr\Http\Client\ClientInterface;

class Client
{
    /**
     * @var mixed
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var mixed
     */
    protected $endpoint = 'https://sandbox.payright.my/';

    /**
     * @var mixed
     */
    protected $paymentCompletion;

    /**
     * @var mixed
     */
    protected $useSandbox = false;

    /**
     * @var mixed
     */
    protected $defaultVersion = 'v1';

    /**
     * @var array
     */
    protected $supportedVersions = [
        'v1' => 'One',
    ];

    /**
     * @param $httpClient
     * @param $config
     */
    public function __construct(ClientInterface $httpClient, array $config)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    /**
     * @param $httpClient
     */
    public static function make(ClientInterface $httpClient, array $config): self
    {
        return new self($httpClient, $config);
    }

    /**
     * @param string $version
     */
    public function collections( ? string $version = null)
    {
        return $this->uses('Collection', $version);
    }

    /**
     * @param string $version
     */
    public function bills( ? string $version = null)
    {
        return $this->uses('Bill', $version);
    }

    /**
     * @param string $version
     */
    public function transactions( ? string $version = null)
    {
        return $this->uses('Transaction', $version);
    }

    /**
     * @param string $version
     */
    public function paymentchannel( ? string $version = null)
    {
        return $this->uses('PaymentChannel', $version);
    }

    /**
     * @return mixed
     */
    public function endpoint() : string
    {
        return $this->useSandbox() ? $this->sandbox() : $this->endpoint;
    }

    /**
     * @return mixed
     */
    public function sandbox() : string
    {
        return 'https://uat.payright.my/api';
    }

    /**
     * @return mixed
     */
    public function useSandbox() : string
    {
        if (!array_key_exists('use_sandbox', $this->config())) {
            $this->useSandbox = false;
        } else {
            $this->useSandbox = $this->config()['use_sandbox'];
        }

        return $this->useSandbox;
    }

    /**
     * @return mixed
     */
    public function config() : array
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function auth(): \Payright\BearerAuth
    {
        return \Payright\BearerAuth::make($this);
    }

    /**
     * @param $service
     */
    public function uses(string $service,  ? string $version)
    {
        if (\is_null($version) || !\array_key_exists($version, $this->supportedVersions)) {
            throw new InvalidArgumentException("Version [{$version}] is not available.");
        }

        $name = str_replace('.', '\\', $service);

        $class = sprintf('%s\%s\%s', $this->getResourceNamespace(), $this->supportedVersions[$version], $name);

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Resource [{$service}] for version [{$version}] is not available.");
        }

        return new $class($this);
    }

    /**
     * @return mixed
     */
    public function version() : string
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function httpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    public function __toString()
    {
        return json_encode($this->config);
    }

    public function getResourceNamespace()
    {
        return __NAMESPACE__;
    }
}
