<?php

declare(strict_types = 1);

namespace UI\Web\Services\HttpRequest;

class RequestDto
{

    public function __construct(
        private string $uri,
        private string $method = 'GET',
        private array $parameters = [],
        private array $cookies = [],
        private array $files = [],
        private array $server = [],
        private string|null $content = null,
    ){
    }

    /**
     * @param  string  $uri
     */
    public function setUri(string $uri)
    : void{
        $this->uri = $uri;
    }

    /**
     * @param  string  $method
     */
    public function setMethod(string $method)
    : void{
        $this->method = $method;
    }

    /**
     * @param  array  $parameters
     */
    public function setParameters(array $parameters)
    : void{
        $this->parameters = $parameters;
    }

    /**
     * @param  array  $cookies
     */
    public function setCookies(array $cookies)
    : void{
        $this->cookies = $cookies;
    }

    /**
     * @param  array  $files
     */
    public function setFiles(array $files)
    : void{
        $this->files = $files;
    }

    /**
     * @param  array  $server
     */
    public function setServer(array $server)
    : void{
        $this->server = $server;
    }

    /**
     * @param  string|null  $content
     */
    public function setContent(?string $content)
    : void{
        $this->content = $content;
    }

    public function toArray()
    : array
    {
        return [
            'uri'        => $this->uri,
            'method'     => $this->method,
            'parameters' => $this->parameters,
            'cookies'    => $this->cookies,
            'files'      => $this->files,
            'server'     => $this->server,
            'content'    => $this->content,
        ];
    }
}
