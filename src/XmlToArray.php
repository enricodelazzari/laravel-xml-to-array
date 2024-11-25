<?php

namespace EnricoDeLazzari\XmlToArray;

use DOMDocument;
use DOMNode;
use Exception;

class XmlToArray
{
    /**
     * Convert XML string to an array.
     *
     * @throws \Exception
     */
    public function convert(string $xmlString): array
    {
        try {
            $dom = new DOMDocument;
            $dom->loadXML($xmlString);

            return $this->convertNodeToArray($dom->documentElement);
        } catch (Exception $e) {
            throw new Exception('Invalid XML provided: '.$e->getMessage());
        }
    }

    /**
     * Recursively convert a DOMNode to an array with attributes and values.
     *
     * @return array|string
     */
    private function convertNodeToArray(DOMNode $node)
    {
        $output = [];

        // Handle attributes
        if ($node->hasAttributes()) {
            foreach ($node->attributes as $attribute) {
                $output['_attributes'][$attribute->nodeName] = $attribute->nodeValue;
            }
        }

        // Handle child nodes
        if ($node->hasChildNodes()) {
            $hasMultipleChildren = false;
            foreach ($node->childNodes as $child) {
                // Skip text nodes containing only whitespace
                if ($child->nodeType === XML_TEXT_NODE && trim($child->nodeValue) === '') {
                    continue;
                }

                if ($child->nodeType === XML_TEXT_NODE) {
                    $output['_value'] = $child->nodeValue;
                } elseif ($child->nodeType === XML_ELEMENT_NODE) {
                    $hasMultipleChildren = true;
                    $childName = $child->nodeName;
                    $childValue = $this->convertNodeToArray($child);

                    // Handle multiple children with the same name
                    if (isset($output[$childName])) {
                        if (! is_array($output[$childName]) || ! isset($output[$childName][0])) {
                            $output[$childName] = [$output[$childName]];
                        }
                        $output[$childName][] = $childValue;
                    } else {
                        $output[$childName] = $childValue;
                    }
                }
            }

            // If there's only a text node and no children, simplify the output
            if (! $hasMultipleChildren && isset($output['_value']) && count($output) === 1) {
                return $output['_value'];
            }
        }

        return $output;
    }
}
