<?php
namespace BingNewsSearch;

require_once './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use BingNewsSearch\Client;
use BingNewsSearch\Enum;
class CategoryTest extends TestCase
{
    public function testGet()
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

        $this->assertEquals(
            $client->category()->get(Enum\Category::EDUCATION())->getCategory(),
            Enum\Category::EDUCATION()
        );
        
        $request = $client->category()->get(Enum\Category::BRAZIL(), Enum\Language::PT_BR());
        $this->assertEquals(
            $request->getCategory(),
            Enum\Category::BRAZIL()
        );
        $this->assertEquals(
            $request->getLanguage(),
            Enum\Language::PT_BR()
        );
    }
}
