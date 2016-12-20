<?php

namespace Tests\Unit\Slack;

use JsonSerializable;
use Tests\Unit\TestCase;
use JSHayes\SlackMessageBuilder\Button;

class ButtonTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $button = new Button('name', 'text');

        $this->assertInstanceOf(Button::class, $button);
        $this->assertInstanceOf(JsonSerializable::class, $button);
    }

    public function testItSetsTheNameAndText()
    {
        $button = new Button('name', 'text');

        $expected = [
            'type' => 'button',
            'name' => 'name',
            'text' => 'text'
        ];
        $this->assertEquals($expected, $button->jsonSerialize());
    }

    public function testItSetsTheStyle()
    {
        $button = new Button('name', 'text');
        $return = $button->setStyle('style');

        $expected = [
            'type' => 'button',
            'name' => 'name',
            'text' => 'text',
            'style' => 'style'
        ];
        $this->assertEquals($expected, $button->jsonSerialize());
        $this->assertSame($button, $return);
    }

    public function testItSetsTheValue()
    {
        $button = new Button('name', 'text');
        $return = $button->setValue('value');

        $expected = [
            'type' => 'button',
            'name' => 'name',
            'text' => 'text',
            'value' => 'value'
        ];
        $this->assertEquals($expected, $button->jsonSerialize());
        $this->assertSame($button, $return);
    }

    public function testItSetsThenRequiredConfirmationFields()
    {
        $button = new Button('name', 'text');
        $return = $button->setConfirmationFields('title', 'text');

        $expected = [
            'type' => 'button',
            'name' => 'name',
            'text' => 'text',
            'confirm' => [
                'title' => 'title',
                'text' => 'text'
            ]
        ];
        $this->assertEquals($expected, $button->jsonSerialize());
        $this->assertSame($button, $return);
    }

    public function testItSetsTheOptionalConfirmationFields()
    {
        $button = new Button('name', 'text');
        $return = $button->setConfirmationFields('title', 'text', 'Sure!', 'Nope');

        $expected = [
            'type' => 'button',
            'name' => 'name',
            'text' => 'text',
            'confirm' => [
                'title' => 'title',
                'text' => 'text',
                'ok_text' => 'Sure!',
                'dismiss_text' => 'Nope'
            ]
        ];
        $this->assertEquals($expected, $button->jsonSerialize());
        $this->assertSame($button, $return);
    }
}
