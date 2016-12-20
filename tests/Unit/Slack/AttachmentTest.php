<?php

namespace Tests\Unit\Slack;

use DateTime;
use JsonSerializable;
use Tests\Unit\TestCase;
use JSHayes\SlackMessageBuilder\Field;
use JSHayes\SlackMessageBuilder\Button;
use JSHayes\SlackMessageBuilder\Attachment;

class AttachmentTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $attachment = new Attachment();

        $this->assertInstanceOf(Attachment::class, $attachment);
        $this->assertInstanceOf(JsonSerializable::class, $attachment);
    }

    public function testItSetsTheFallback()
    {
        $attachment = new Attachment();
        $return = $attachment->setFallback('fallback');

        $expected = [
            'fallback' => 'fallback'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheColour()
    {
        $attachment = new Attachment();
        $return = $attachment->setColour('#ffffff');

        $expected = [
            'color' => '#ffffff'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsThePretext()
    {
        $attachment = new Attachment();
        $return = $attachment->setPretext('This is some pretext');

        $expected = [
            'pretext' => 'This is some pretext'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItCanSetTheAuthorName()
    {
        $attachment = new Attachment();
        $return = $attachment->setAuthor('Justin');

        $expected = [
            'author_name' => 'Justin',
            'author_link' => '',
            'author_icon' => ''
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItCanSetTheAuthorInformation()
    {
        $attachment = new Attachment();
        $return = $attachment->setAuthor('Justin', 'link', 'icon');

        $expected = [
            'author_name' => 'Justin',
            'author_link' => 'link',
            'author_icon' => 'icon'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheTitle()
    {
        $attachment = new Attachment();
        $return = $attachment->setTitle('title');

        $expected = [
            'title' => 'title',
            'title_link' => ''
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheTitleAndLink()
    {
        $attachment = new Attachment();
        $return = $attachment->setTitle('title', 'link');

        $expected = [
            'title' => 'title',
            'title_link' => 'link'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheText()
    {
        $attachment = new Attachment();
        $return = $attachment->setText('text');

        $expected = [
            'text' => 'text'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheImage()
    {
        $attachment = new Attachment();
        $return = $attachment->setImage('url');

        $expected = [
            'image_url' => 'url'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheThumb()
    {
        $attachment = new Attachment();
        $return = $attachment->setThumb('url');

        $expected = [
            'thumb_url' => 'url'
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheFooterWithRequireAttributes()
    {
        $attachment = new Attachment();
        $return = $attachment->setFooter('footer text');

        $expected = [
            'footer' => 'footer text',
            'footer_icon' => ''
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItSetsTheFooterWithOptionalAttributes()
    {
        $time = new DateTime();
        $attachment = new Attachment();
        $return = $attachment->setFooter('footer text', 'icon', $time);

        $expected = [
            'footer' => 'footer text',
            'footer_icon' => 'icon',
            'ts' => $time->getTimestamp()
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertSame($attachment, $return);
    }

    public function testItCanAddOneField()
    {
        $attachment = new Attachment();
        $field = $attachment->addField('Title', 'Value');

        $expected = [
            'fields' => [
                [
                    'title' => 'Title',
                    'value' => 'Value'
                ]
            ]
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertInstanceOf(Field::class, $field);
    }

    public function testItCanAddMultipleFields()
    {
        $attachment = new Attachment();
        $attachment->addField('Title1', 'Value1');
        $attachment->addField('Title2', 'Value2');

        $expected = [
            'fields' => [
                [
                    'title' => 'Title1',
                    'value' => 'Value1'
                ],
                [
                    'title' => 'Title2',
                    'value' => 'Value2'
                ]
            ]
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
    }

    public function testItCanAddOneButton()
    {
        $attachment = new Attachment();
        $button = $attachment->addButton('name', 'text');

        $expected = [
            'actions' => [
                [
                    'name' => 'name',
                    'text' => 'text',
                    'type' => 'button'
                ]
            ]
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertInstanceOf(Button::class, $button);
    }

    public function testItCanAddMultipleButtons()
    {
        $attachment = new Attachment();
        $attachment->addButton('name1', 'text1');
        $attachment->addButton('name2', 'text2');

        $expected = [
            'actions' => [
                [
                    'name' => 'name1',
                    'text' => 'text1',
                    'type' => 'button'
                ],
                [
                    'name' => 'name2',
                    'text' => 'text2',
                    'type' => 'button'
                ]
            ]
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
    }

    public function testItCanAddOnePrimaryButton()
    {
        $attachment = new Attachment();
        $button = $attachment->addPrimaryButton('name', 'text');

        $expected = [
            'actions' => [
                [
                    'name' => 'name',
                    'text' => 'text',
                    'type' => 'button',
                    'style' => 'primary'
                ]
            ]
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertInstanceOf(Button::class, $button);
    }

    public function testItCanAddOneDangerButton()
    {
        $attachment = new Attachment();
        $button = $attachment->addDangerButton('name', 'text');

        $expected = [
            'actions' => [
                [
                    'name' => 'name',
                    'text' => 'text',
                    'type' => 'button',
                    'style' => 'danger'
                ]
            ]
        ];

        $this->assertEquals($expected, $attachment->JsonSerialize());
        $this->assertInstanceOf(Button::class, $button);
    }
}
