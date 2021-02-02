<?php

namespace BingNewsSearch\Requests\Trending;

use BingNewsSearch\Requests;
use BingNewsSearch\Structs;
use BingNewsSearch\Enum;
use BingNewsSearch\Exceptions;
use DateTime;

class Get extends Requests\Request
{
    private ?Enum\Language $language;
    private Enum\SafeSearch $safeSearch;
    private Enum\SortBy $sortBy;
    private ?DateTime $since = null;
    private array $trending = [];

    public function initialize(Enum\Language $language = null)
    {
        $this->language = $language;
        $this->safeSearch = Enum\SafeSearch::MODERATE();
        $this->sortBy = Enum\SortBy::DATE();
    }

    public function onBeforeRequest(): ?Exceptions\Exception
    {
        if (isset($this->since) && (!$this->sortBy || !$this->sortBy->isDate())) {
            return new Exceptions\InvalidParameterException("Since only available with Date sort.");
        }
        return null;
    }

    public function getMethod(): Enum\RequestMethod
    {
        return Enum\RequestMethod::GET();
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

    public function getQuery(): array
    {
        return [
            'mkt' => (string)$this->language,
            'safeSearch' => (string)$this->safeSearch,
            'since' => $this->since,
            'sortBy' => (string)$this->sortBy,
        ];
    }

    public function getPath(): string
    {
        return '/news/trendingtopics';
    }

    public function toArray(): array
    {
        return [
            'language' => $this->language,
            'safeSearch' => $this->safeSearch,
            'sortBy' => $this->sortBy,
            'since' => $this->since,
            'trending' => $this->trending,
        ];
    }

    public function setResponseData(array $data): self
    {
        foreach ($data as $_trending) {
            $this->trending[] = new Structs\Trending($_trending);
        }
        return $this;
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

    public function getTrending(): array
    {
        return $this->trending;
    }
}
