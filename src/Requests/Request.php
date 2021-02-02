<?php

namespace BingNewsSearch\Requests;

use BingNewsSearch\Enum;
use BingNewsSearch\Client;
use GuzzleHttp\Psr7;

abstract class Request implements \JsonSerializable
{
    private Client $_client;
    protected Psr7\Response $response;
    protected ?bool $status = null;
    protected ?string $message = null;
    protected ?\Exception $error = null;
    protected array $formData = [];
    protected array $query = [];
    protected string $webUrl = '';

    abstract public function getMethod(): Enum\RequestMethod;
    abstract public function getPath(): string;
    abstract public function toArray(): array;
    abstract public function onBeforeRequest(): ?\Exception;

    public function __construct(Client $client, ...$args)
    {   
        $this->_client = $client;
        if (method_exists($this, "initialize")) call_user_func_array([$this, "initialize"], $args);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function setError(\Exception $data): self
    {
        if ($data) $this->error = $data;
        return $this;
    }

    public function setResponse(Psr7\Response $requestResponse): self
    {
        $this->requestResponse = $requestResponse;
        $response = json_decode($requestResponse->getBody()->getContents(), true);
        $this->status = ($requestResponse->getStatusCode() === 200);
        $this->webUrl = $response['webSearchUrl'] ?? '';
        $this->message = $requestResponse->getReasonPhrase() ?? '';
        if (isset($response["value"])) $this->setResponseData($response["value"]);
        return $this;
    }

    public function getResponse(): Psr7\Response
    {
        return $this->response;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->statusCode;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getFormData(): array
    {
        return $this->formData;
    }

    public function request()
    {
        $this->_client->request($this);
        return $this;
    }

    public function getError(): ?\Exception
    {
        return $this->error;
    }

    public function getApiClient(): Client
    {
        return $this->_client;
    }
}