<?php

namespace BingNewsSearch\Structs;

use BingNewsSearch\Enum;
use DateTime;

class News 
{
    private string $name;
    private string $description;
    private string $url;
    private ?Image $image;
    private ?array $abouts;
    private array $providers;
    private ?DateTime $datePublished;
    private ?Enum\IMarketCategory $category;

    public function __construct(array $data)
    {
        dump($data);
        die;
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->url = $data['url'] ?? '';
        $this->image = isset($data['image']) ? new Image($data['image']) : null;
        if (isset($data['about'])) foreach ($data['about'] as $_about) {
            $this->abouts[] = new AboutNews($_about);
        }
        if (isset($data['provider'])) foreach ($data['provider'] as $_provider) {
            $this->providers[] = new Provider($_provider);
        }
        $this->category = isset ($data['category']) ? new Enum\Category($data['category']) : null;
        $this->datePublished = isset($data['datePublished']) ? new DateTime(date('Y-m-d h:i:s', strtotime($data['datePublished']))) : null;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function abouts(): ?array
    {
        return $this->abouts;
    }

    public function providers(): array
    {
        return $this->providers;
    }

    public function datePublished(): DateTime
    {
        return $this->datePublished;
    }

    public function category(): ?Enum\IMarketCategory
    {
        return $this->category;
    }
}