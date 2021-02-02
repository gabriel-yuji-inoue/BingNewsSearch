<?php
namespace BingNewsSearch\Requests;

use BingNewsSearch\Enum;

class Category extends SubRequest
{
  public function get(Enum\IMarketCategory $category, Enum\Language $language = null): Category\Get
  {
    return $this->factory("get", $category, $language);
  }
}