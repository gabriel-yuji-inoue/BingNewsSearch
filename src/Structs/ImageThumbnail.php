<?php

namespace BingNewsSearch\Structs;

class ImageThumbnail 
{
    private string $contentUrl;
    private ?int $width;
    private ?int $height;

    public function __construct(array $data)
    {
        $this->contentUrl = $data['contentUrl'] ?? '';
        $this->width = $data['width'] ?? null;
        $this->height = $data['height'] ?? null;
    }

    public function contentUrl(): string
    {
        return $this->contentUrl;
    }

    public function width(): ?int
    {
        return $this->width;
    }

    public function height(): ?int
    {
        return $this->height;
    }  
}