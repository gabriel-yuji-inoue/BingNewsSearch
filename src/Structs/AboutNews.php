<?php

namespace BingNewsSearch\Structs;

class AboutNews
{
    private string $name;
    private string $readLink;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->readLink = $data['readLink'] ?? '';
    }

    public function readLink(): string
    {
        return $this->readLink;
    }

    public function name(): string
    {
        return $this->name;
    }
}