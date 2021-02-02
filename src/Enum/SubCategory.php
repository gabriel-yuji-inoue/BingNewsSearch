<?php
namespace BingNewsSearch\Enum;

use InvalidArgumentException;

class SubCategory extends Enum implements IMarketCategory
{
    public const ENTERTAINMENT_MOVIEANDTV = 'Entertainment_MovieAndTV';
    public const ENTERTAINMENT_MUSIC = 'Entertainment_Music';
    public const TECHNOLOGY = 'Technology';
    public const SCIENCE = 'Science';
    public const SPORTS_GOLF = 'Sports_Golf';
    public const SPORTS_MLB = 'Sports_MLB';
    public const SPORTS_NBA = 'Sports_NBA';
    public const SPORTS_NFL = 'Sports_NFL';
    public const SPORTS_NHL = 'Sports_NHL';
    public const SPORTS_SOCCER = 'Sports_Soccer';
    public const SPORTS_TENNIS = 'Sports_Tennis';
    public const SPORTS_CFB = 'Sports_CFB';
    public const SPORTS_CBB = 'Sports_CBB';
    public const US_NORTHEAST = 'US_Northeast';
    public const US_SOUTH = 'US_South';
    public const US_MIDWEST = 'US_Midwest';
    public const US_WEST = 'US_West';

    public function parent(): Category
    {
        switch ($this->value) {
            case self::ENTERTAINMENT_MOVIEANDTV:
            case self::ENTERTAINMENT_MUSIC:
                return Category::ENTERTAINMENT();
            case self::TECHNOLOGY: 
            case self::SCIENCE: 
                return Category::SCIENCEANDTECHNOLOGY();
            case self::SPORTS_GOLF:
            case self::SPORTS_MLB:
            case self::SPORTS_NBA:
            case self::SPORTS_NFL:
            case self::SPORTS_NHL:
            case self::SPORTS_SOCCER:
            case self::SPORTS_TENNIS:
            case self::SPORTS_CFB:
            case self::SPORTS_CBB:
                return Category::SPORTS();
            case self::US_NORTHEAST:
            case self::US_SOUTH:
            case self::US_MIDWEST:
            case self::US_WEST:
                return Category::US();
            default:
                throw new InvalidArgumentException("Invalid subcategory market. Check BingNewsSearch\Enum\SubCategory constants options.");
                
        }
    }
}