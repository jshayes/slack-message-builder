<?php

namespace Tests\Unit\Slack;

use Tests\Unit\TestCase;
use InvalidArgumentException;
use JSHayes\SlackMessageBuilder\AttributeCollection;

class AttributeCollectionTest extends TestCase
{
    public function testPuttingAnItemAddsTheItem()
    {
        $collection = new AttributeCollectionDouble();

        $collection->callPutItem('key', 'value');
        $result = $collection->jsonSerialize();

        $expected = [
            'key' => 'value',
        ];
        $this->assertInternalType('array', $result);
        $this->assertEquals($expected, $result);
    }

    public function testPuttingMultipleItemsAddsAllTheItems()
    {
        $collection = new AttributeCollectionDouble();

        $collection->callPutItem('string-key', 'value');
        $collection->callPutItem('int-key', 1);
        $collection->callPutItem('bool-key', true);
        $result = $collection->jsonSerialize();

        $expected = [
            'string-key' => 'value',
            'int-key' => 1,
            'bool-key' => true
        ];
        $this->assertInternalType('array', $result);
        $this->assertEquals($expected, $result);
    }

    public function testPuttingTheSameItemMultipleTimeReplacesExistingItem()
    {
        $collection = new AttributeCollectionDouble();

        $collection->callPutItem('key', 'value1');
        $collection->callPutItem('key', 'value2');
        $result = $collection->jsonSerialize();

        $expected = [
            'key' => 'value2',
        ];
        $this->assertInternalType('array', $result);
        $this->assertEquals($expected, $result);
    }

    public function testAppendingAnItemAddsTheItemToAnArray()
    {
        $collection = new AttributeCollectionDouble();

        $collection->callAppendItem('key', 'value');
        $result = $collection->jsonSerialize();

        $expected = [
            'key' => ['value'],
        ];
        $this->assertInternalType('array', $result);
        $this->assertEquals($expected, $result);
    }

    public function testAppendingMutlipleItemsAddsTheItemToTheArrays()
    {
        $collection = new AttributeCollectionDouble();

        $collection->callAppendItem('key1', 'value1');
        $collection->callAppendItem('key1', 'value2');
        $collection->callAppendItem('key1', 'value3');
        $collection->callAppendItem('key2', 'value1');
        $collection->callAppendItem('key2', 'value2');
        $result = $collection->jsonSerialize();

        $expected = [
            'key1' => ['value1', 'value2', 'value3'],
            'key2' => ['value1', 'value2'],
        ];
        $this->assertInternalType('array', $result);
        $this->assertEquals($expected, $result);
    }

    public function testPuttingAnItemAfterAppendingItemWithTheSameKeyFails()
    {
        $this->expectException(InvalidArgumentException::class);

        $collection = new AttributeCollectionDouble();

        $collection->callAppendItem('key', 'value');
        $collection->callPutItem('key', 'value');
    }

    public function testAppendingAnItemAfterPuttingAnItemWithTheSameKeyFails()
    {
        $this->expectException(InvalidArgumentException::class);

        $collection = new AttributeCollectionDouble();

        $collection->callPutItem('key', 'value');
        $collection->callAppendItem('key', 'value');
    }

    public function testNestedAttributeCollectionAreFormattedProperly()
    {
        $collection1 = new AttributeCollectionDouble();
        $collection2 = new AttributeCollectionDouble();

        $collection1->callPutItem('key1', 'value1');
        $collection2->callPutItem('key2', 'value2');
        $collection1->callAppendItem('nested-key', $collection2);
        $result = $collection1->jsonSerialize();

        $expected = [
            'key1' => 'value1',
            'nested-key' => [[
                'key2' => 'value2'
            ]]
        ];
        $this->assertInternalType('array', $result);
        $this->assertEquals($expected, $result);
    }
}

class AttributeCollectionDouble extends AttributeCollection
{
    public function callPutItem(string $key, $value)
    {
        $this->putItem($key, $value);
    }

    public function callAppendItem(string $key, $value)
    {
        $this->appendItem($key, $value);
    }
}
