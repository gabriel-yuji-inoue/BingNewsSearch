<?php

namespace BingNewsSearch\Requests;

use BingNewsSearch\Client;

abstract class SubRequest
{
    private Client $client;

    public function __construct(Client $client, ...$args)
    {   
        $this->client = $client;
        if (method_exists($this, "initialize")) call_user_func_array([$this, "initialize"], $args);
    }

    public function factory($request, ...$args)
    {
        $request = static::class."\\".ucfirst($request);
        if (!class_exists($request)) throw new \BadMethodCallException("Request $request not exists");
        return new $request($this->client, ...$args);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}