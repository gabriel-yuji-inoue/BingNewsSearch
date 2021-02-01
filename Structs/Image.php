<?php

namespace BingNewsSearch\Structs;

class Image
{
    private ?ImageThumbnail $thumbnail = null;
    private ?string $url = null;
    private array $providers = [];

    public function __construct(array $data)
    {
        $this->thumbnail = isset($data['thumbnail']) ? new ImageThumbnail($data['thumbnail']) : null;
        $this->url = $data['url'] ?? null;
        if (isset($data['provider'])) foreach ($data['provider'] as $_provider) {
            $this->providers[] = new Provider($_provider);
        }
    }

    public function thumbnail(): ?ImageThumbnail
    {
        return $this->thumbnail;
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function providers(): array
    {
        return $this->providers;
    }
}