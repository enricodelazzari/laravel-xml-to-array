<?php

use EnricoDeLazzari\XmlToArray\Facades\XmlToArray;

it('converts simple XML to array', function () {
    $xml = '<root><item>value</item></root>';
    $result = XmlToArray::convert($xml);

    expect($result)
        ->toBeArray()
        ->toEqual(['item' => 'value']);
});

it('handles nested elements', function () {
    $xml = '<root><parent><child>value</child></parent></root>';
    $result = XmlToArray::convert($xml);

    expect($result)
        ->toBeArray()
        ->toEqual(['parent' => ['child' => 'value']]);
});

it('handles multiple elements with the same name', function () {
    $xml = '<root><item>value1</item><item>value2</item></root>';
    $result = XmlToArray::convert($xml);

    expect($result)
        ->toBeArray()
        ->toEqual(['item' => ['value1', 'value2']]);
});

it('throws an exception for invalid XML', function () {
    $invalidXml = '<root><item></root>';

    XmlToArray::convert($invalidXml);
})->throws(Exception::class, 'Invalid XML provided');

it('converts XML with attributes and values correctly', function () {
    $xml = <<<'XML'
<root>
    <Good_guy attr1="value">
        <name>Luke Skywalker</name>
        <weapon>Lightsaber</weapon>
    </Good_guy>
    <Bad_guy>
        <name>Sauron</name>
        <weapon>Evil Eye</weapon>
    </Bad_guy>
    <The_survivor house="Hogwarts">Harry Potter</The_survivor>
</root>
XML;

    $result = XmlToArray::convert($xml);

    expect($result)->toEqual([
        'Good_guy' => [
            '_attributes' => ['attr1' => 'value'],
            'name' => 'Luke Skywalker',
            'weapon' => 'Lightsaber',
        ],
        'Bad_guy' => [
            'name' => 'Sauron',
            'weapon' => 'Evil Eye',
        ],
        'The_survivor' => [
            '_attributes' => ['house' => 'Hogwarts'],
            '_value' => 'Harry Potter',
        ],
    ]);
});
