<?php
namespace BingNewsSearch;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;
use BingNewsSearch\Exceptions;
use BingNewsSearch\Requests;

class Client
{
    private GuzzleClient $_client;
    private string $endpoint;
    private string $token;
    private string $version;
    private bool $verifySsl = true;
    private bool $enableExceptions = false;

    public function __construct(string $endpoint, string $token, string $version = 'v7.0')
    {
        $this->endpoint = $endpoint;
        $this->token = $token;
        $this->version = $version;
    }

    public function request(Requests\Request $request)
    {
        if (empty($this->_client)) $this->_client = new GuzzleClient(['verify' => $this->verifySsl]);

        try {
            $exception = $request->onBeforeRequest();
            if ($exception) {
                $request->setError($exception);
                if ($this->enableExceptions) throw $exception;
            }
            $response = $this->_client->request((string)$request->getMethod(), $this->getUrl($request->getPath()), [
                RequestOptions::QUERY => $request->getQuery(),
                RequestOptions::FORM_PARAMS => $request->getFormData(),
                RequestOptions::HEADERS => [ 'Ocp-Apim-Subscription-Key' => $this->token ],
            ]);
        } catch (\Throwable $th) {
            $request->setError($th);
            if ($this->enableExceptions) {
                if (preg_match('/Could not resolve host:/', $th->getMessage())) {
                    throw new Exceptions\ConnectionException("Could not resolve endpoint. Check your network connection.");
                }
                throw new Exceptions\Exception($th->getMessage());
            }
            return $request;
        }
        $request->setResponse($response);
        return $request;
    }
    
    public function factory(string $request, ...$args)
    {
        $request = "BingNewsSearch\Requests\\".ucfirst($request);
        if (!class_exists($request)) throw new \BadMethodCallException("Request $request not exists");
        return new $request($this, ...$args);
    }

    public function enableExceptions(bool $data = true): self
    {
        $this->enableExceptions = $data;
        return $this;
    }

    public function disableSsl(bool $data = true): self
    {
        $this->verifySsl = !$data;
        return $this;
    }
    
    public function getUrl(string $path = null): string
    {
        $this->endpoint = preg_replace('/\/$/', '', $this->endpoint);
        if ($path) $path = preg_replace('/^\//', '', $path);
        return $this->getEndpoint()."/".$this->getVersion()."/".$path;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function trending(): Requests\Trending
    {
        return $this->factory('trending');
    }

    public function search(): Requests\Search
    {
        return $this->factory('search');
    }

    public function category(): Requests\Category
    {
        return $this->factory('category');
    }
}