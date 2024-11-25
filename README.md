# XML to Array

> [!WARNING]  
> This is still a work in progress software. Use with caution.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/enricodelazzari/laravel-xml-to-array.svg?style=flat-square)](https://packagist.org/packages/enricodelazzari/laravel-xml-to-array)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/enricodelazzari/laravel-xml-to-array/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/enricodelazzari/laravel-xml-to-array/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/enricodelazzari/laravel-xml-to-array/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/enricodelazzari/laravel-xml-to-array/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/enricodelazzari/laravel-xml-to-array.svg?style=flat-square)](https://packagist.org/packages/enricodelazzari/laravel-xml-to-array)

Easily convert XML to PHP arrays in your Laravel projects.

## Installation

You can install the package via composer:

```bash
composer require enricodelazzari/laravel-xml-to-array
```

## Usage

Convert an XML string to an array:

```php
use EnricoDeLazzari\XmlToArray\Facades\XmlToArray;

use YourVendorName\XmlToArray\Facades\XmlToArray;

$xml = <<<XML
<root>
    <Good_guy attr1="value">
        <name>Luke Skywalker</name>
        <weapon>Lightsaber</weapon>
    </Good_guy>
</root>
XML;

$result = XmlToArray::convert($xml);

/* Result:
[
    'Good_guy' => [
        '_attributes' => ['attr1' => 'value'],
        'name' => 'Luke Skywalker',
        'weapon' => 'Lightsaber'
    ]
]
*/

```

#Example with Nested Elements and Attributes
```php
$xml = <<<XML
<root>
    <Bad_guy>
        <name>Sauron</name>
        <weapon>Evil Eye</weapon>
    </Bad_guy>
    <The_survivor house="Hogwarts">Harry Potter</The_survivor>
</root>
XML;

$result = XmlToArray::convert($xml);

/* Result:
[
    'Bad_guy' => [
        'name' => 'Sauron',
        'weapon' => 'Evil Eye'
    ],
    'The_survivor' => [
        '_attributes' => ['house' => 'Hogwarts'],
        '_value' => 'Harry Potter'
    ]
]
*/
```
#Example with Multiple Elements
```php
$xml = <<<XML
<root>
    <item>value1</item>
    <item>value2</item>
</root>
XML;

$result = XmlToArray::convert($xml);

/* Result:
[
    'item' => ['value1', 'value2']
]
*/
```
#Handling Invalid XML
If the XML is invalid, an exception is thrown:
```php
$invalidXml = '<root><item></root>';

try {
    $result = XmlToArray::convert($invalidXml);
} catch (\Exception $e) {
    echo $e->getMessage(); // "Invalid XML provided"
}
```
## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Enrico De Lazzari](https://github.com/enricodelazzari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
