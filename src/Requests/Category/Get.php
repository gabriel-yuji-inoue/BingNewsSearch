<?php

namespace BingNewsSearch\Requests\Category;

use BingNewsSearch\Requests;
use BingNewsSearch\Structs;
use BingNewsSearch\Enum;
use DateTime;
use DomainException;

class Get extends Requests\Request
{
    private Enum\IMarketCategory $category;
    private ?Enum\Language $language;
    private Enum\SafeSearch $safeSearch;
    private Enum\SortBy $sortBy;
    private ?DateTime $since = null;
    private array $news = [];

    public function initialize(Enum\IMarketCategory $category, Enum\Language $language = null)
    {
        $this->category = $category;
        $this->language = $language;
        $this->safeSearch = Enum\SafeSearch::MODERATE();
        $this->sortBy = Enum\SortBy::DATE();
    }

    public function onBeforeRequest(): ?\Exception
    {
        if ($this->since && (!$this->sortBy || !$this->sortBy->isDate())) return new DomainException("Since only available with Date sort.");
        return null;
    }

    public function setSafeSearch(Enum\SafeSearch $data): self
    {
        $this->safeSearch = $data;
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
            'category' => (string)$this->category,
            'mkt' => (string)$this->language,
            'safeSearch' => (string)$this->safeSearch,
            'sortBy' => (string)$this->sortBy,
        ];
    }

    public function getPath(): string
    {
        return '/news';
    }

    public function toArray(): array
    {
        return [
            'category' => $this->category,
            'language' => $this->language,
            'safeSearch' => $this->safeSearch,
            'since' => $this->since,
            'sortBy' => $this->sortBy,
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

    public function getCategory(): Enum\IMarketCategory
    {
        return $this->category;
    }

    public function getLanguage(): ?Enum\Language
    {
        return $this->language;
    }

    public function getSafeSearch(): Enum\SafeSearch
    {
        return $this->safeSearch;
    }

    public function getSortBy(): Enum\SortBy
    {
        return $this->sortBy;
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
