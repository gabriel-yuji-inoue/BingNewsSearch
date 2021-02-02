<?php

namespace BingNewsSearch\Requests\Search;

use BingNewsSearch\Requests;
use BingNewsSearch\Structs;
use BingNewsSearch\Enum;
use DateTime;
use DomainException;
use InvalidArgumentException;

class Get extends Requests\Request
{
    private string $q;
    private Enum\SafeSearch $safeSearch;
    private Enum\SortBy $sortBy;
    private string $quantity;
    private ?DateTime $since = null;
    private array $news = [];

    public function initialize(string $query = '')
    {
        $this->q = $query;
    }

    public function onBeforeRequest(): ?\Exception
    {
        if ($this->quantity < 1 || $this->quantity > 100) return new InvalidArgumentException("Expected quantity between 1 and 100.");
        if ($this->since && (!$this->sortBy || !$this->sortBy->isDate())) return new DomainException("Since only available with Date sort.");
        return null;
    }
    
    public function setSafeSearch(Enum\SafeSearch $data): self
    {
        $this->safeSearch = $data;
        return $this;
    }

    public function setQuantity(int $data = 10): self
    {
        $this->quantity = $data;
        return $this;
    }

    public function since(DateTime $data): self
    {
        $this->since = $data;
        return $this;
    }

    public function sortBy(Enum\SortBy $data): self
    {
        $this->sortBy = $data;
        return $this;
    }

    public function getMethod(): Enum\RequestMethod
    {
        return Enum\RequestMethod::GET();
    }

    public function getQuery(): array
    {
        return [
            'q' => $this->q,
            'count' => $this->quantity,
        ];
    }

    public function getPath(): string
    {
        return '/news/search';
    }

    public function toArray(): array
    {
        return [
            'language' => $this->language,
            'safeSearch' => $this->safeSearch,
            'since' => $this->since,
            'sortBy' => $this->sortBy,
            'query' => $this->q,
            'quantity' => $this->quantity,
            'news' => $this->news,
        ];
    }

    public function setResponseData(array $data): self
    {
        foreach ($data as $_news) {
            $this->news[] = new Structs\News($_news);
        }
        return $this;
    }

    public function getQ(): string
    {
        return $this->q;
    }

    public function getSafeSearch(): Enum\SafeSearch
    {
        return $this->safeSearch;
    }

    public function getSortBy(): Enum\SortBy
    {
        return $this->sortBy;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function getSince(): ?DateTime
    {
        return $this->since;
    }

    
    public function getNews(): array
    {
        return $this->news;
    }
}
