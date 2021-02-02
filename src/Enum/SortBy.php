<?php
namespace BingNewsSearch\Enum;

class SortBy extends Enum
{
    public const DATE  = 'Date';
    public const RELEVANCE = 'Relevance';

    public function isDate(): bool
    {
        return $this->value === self::DATE;
    }
    
    public function isRelevance(): bool
    {
        return $this->value === self::DATE;
    }
}