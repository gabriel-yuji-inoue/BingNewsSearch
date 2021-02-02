<?php
include_once("../../vendor/autoload.php");

use PHPUnit\Framework\TestCase;
use BingNewsSearch\Client;
use BingNewsSearch\Enum;
class CategoryTest extends TestCase
{
    public function getTest()
    {
        $client = new Client('', '');
        $this->assertInstanceOf(
            '\BingNewsSearch\Requests\Category',
            $client->category()
        );
        
        $this->assertInstanceOf(
            '\BingNewsSearch\Requests\Category\Get',
            $client->category()->get(Enum\Category::EDUCATION())
        );
    }
}
