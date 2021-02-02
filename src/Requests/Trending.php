<?php
namespace BingNewsSearch\Requests;

use BingNewsSearch\Enum;

class Trending extends SubRequest
{
  public function get(Enum\Language $language = null): Trending\Get
  {
    return $this->factory("get", $language);
  }
}