# BingNewsSearch API Library #
### See more of this API at: https://docs.microsoft.com/en-us/bing/search-apis/bing-news-search ###
___
## Dependencies ##
 - PHP7.4 >
 - GuzzleHttp 7.0.x >
___
## Instalation ##
```
composer require bing-news-search/bing-news-search
```
___

## Usage of Api bing NEWS microsoft an easy way ##

### Initialize the Client instance ###
```php
$client = new Client(
  'apibingurl.com.br',  // https://api.bing.microsoft.com/
  'your_secret_key' // a1b2c3d4e5f6g7h8a1b2c3d4e5f6g7h8
);
```

### Configure client ###
```php
$client->enableExceptions(); // throw exceptions for debug
$client->disableSsl(); // disable Guzzle verification SSL
```

### Search by category ###
```php
// Ex: Search by business category, with pt_BR language, without safe search restriction;
$request = $client->category()
  ->get(Enum\Category::BUSINESS(), Enum\Language::PT_BR())
  ->setSafeSearch(Enum\SafeSearch::OFF())
  ->request();
$news = $request->news();
```

### Search by key word ###
```php
// Ex: Search by key word, limited at 50 items, with safe search restriction;
 $request = $client->search()
    ->get('something cool')
    ->setQuantity(50)
    ->setSafeSearch(Enum\SafeSearch::STRICT())
    ->request();
$news = $request->news();
```

### Search by trending topics ###
```php
// Ex: Get trending topics news, with en_US language.
 $request = $client->trending()
    ->get(Enum\Language::EN_US())
    ->request();
$news = $request->trending();
```

__MORE__
___
Check BingNewsSearch\Enum classes to know all avaiables search configurations, such as: Categories and SubCategories, Languages and more..