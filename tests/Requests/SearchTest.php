<?php
namespace BingNewsSearch;

require_once './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use BingNewsSearch\Client;
class SearchTest extends TestCase
{
    public function testGet()
    {
        $client = new Client('', '');
        $this->assertInstanceOf(
            '\BingNewsSearch\Requests\Search',
            $client->search()
        );
        
        $this->assertInstanceOf(
            '\BingNewsSearch\Requests\Search\Get',
            $client->search()->get('something cool')
        );

        $this->assertEquals(
            $client->search()->get('something cool')->getQ(),
            'something cool'
        );
    }
}
