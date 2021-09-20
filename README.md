# PHP Dictionary

This is base PHP Dictionary library. Dictionaries are used for static data lists storing.

## Installation

You can install the package via composer:

```bash
composer require jcshoww/php-dictionary
```

## Usage

Create your own dictionary and extend it from base dictionary class. Look example below:

```bash
use Jcshoww\PHPDictionary\Dictionary;

class BindingSideDictionary extends Dictionary
{
    public const FRONT = 1;

    public const BACK = 2;

    public const LEFT = 3;
    
    public const RIGHT = 4;

    /**
     * {@inheritDoc}
     */
    public static function getValues(): array
    {
        return [
            static::FRONT => 'Front',
            static::BACK => 'Back',
            static::LEFT => 'Left',
            static::RIGHT => 'Right',
        ];
    }
}

```