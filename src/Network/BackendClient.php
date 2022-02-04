<?php

namespace App\Network;

use GuzzleHttp\Client;

class BackendClient
{
    /** @var Client */
    private Client $client;

    /**
     * BackendClient constructor.
     * @param array $backendClientConfig
     */
    public function __construct(array $backendClientConfig)
    {
        $this->client = new Client($backendClientConfig);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
