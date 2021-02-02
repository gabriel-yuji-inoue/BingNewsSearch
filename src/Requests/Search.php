<?php
namespace BingNewsSearch\Requests;

class Search extends SubRequest
{
  public function get(string $query): Search\Get
  {
    return $this->factory("get", $query);
  }
}