<?php

namespace Tests\Unit\Slack;

use JsonSerializable;
use Tests\Unit\TestCase;
use JSHayes\SlackMessageBuilder\Field;

class FieldTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $field = new Field('title', 'value');

        $this->assertInstanceOf(Field::class, $field);
        $this->assertInstanceOf(JsonSerializable::class, $field);
    }

    public function testItSetsTheTitleAndValue()
    {
        $field = new Field('title', 'value');

        $expected = [
            'title' => 'title',
            'value' => 'value'
        ];
        $this->assertEquals($expected, $field->jsonSerialize());
    }

    public function testItCanBeSetToShort()
    {
        $field = new Field('title', 'value');
        $return = $field->setShort();

        $expected = [
            'title' => 'title',
            'value' => 'value',
            'short' => true
        ];
        $this->assertEquals($expected, $field->jsonSerialize());
        $this->assertSame($field, $return);
    }

    public function testItCanBeSetToNotShort()
    {
        $field = new Field('title', 'value');
        $return = $field->setNotShort();

        $expected = [
            'title' => 'title',
            'value' => 'value',
            'short' => false
        ];
        $this->assertEquals($expected, $field->jsonSerialize());
        $this->assertSame($field, $return);
    }
}
