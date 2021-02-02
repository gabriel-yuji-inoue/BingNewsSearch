<?php

namespace BingNewsSearch\Structs;

class Provider
{
    private string $_type;
    private string $name;
    private ?Image $image;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->image = isset($data['image']) ? new Image($data['image']) : null;
        $this->_type = $data['_type'] ?? '';
    }

    public function type(): string
    {
        return $this->_type;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function image(): ?Image
    {
        return $this->image;
    }
}