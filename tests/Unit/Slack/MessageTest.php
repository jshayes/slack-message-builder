<?php

namespace Tests\Unit\Slack;

use JsonSerializable;
use Tests\Unit\TestCase;
use JSHayes\SlackMessageBuilder\Message;
use JSHayes\SlackMessageBuilder\Attachment;

class MessageTest extends TestCase
{
    public function testItIsInstantiatable()
    {
        $message = new Message();

        $this->assertInstanceOf(Message::class, $message);
        $this->assertInstanceOf(JsonSerializable::class, $message);
    }

    public function testItSetsTheTitle()
    {
        $message = new Message('text');

        $this->assertEquals(['text' => 'text'], $message->JsonSerialize());
    }

    public function testItSetsTheUsername()
    {
        $message = new Message();
        $return = $message->setUsername('username');

        $expected = [
            'text' => '',
            'username' => 'username'
        ];
        $this->assertEquals($expected, $message->JsonSerialize());
        $this->assertSame($message, $return);
    }

    public function testAddAttachmentAddsAnAttachment()
    {
        $message = new Message('text');
        $attachment = $message->addAttachment('title', 'text');

        $expected = [
            'text' => 'text',
            'attachments' => [
                [
                    'title' => 'title',
                    'title_link' => '',
                    'text' => 'text'
                ]
            ]
        ];
        $this->assertInstanceOf(Attachment::class, $attachment);
        $this->assertEquals($expected, $message->JsonSerialize());
    }

    public function testAddingMultipleAttachmentsAddsMutlipleAttachments()
    {
        $message = new Message('text');
        $attachment1 = $message->addAttachment('title1', 'text1');
        $attachment2 = $message->addAttachment('title2', 'text2');

        $expected = [
            'text' => 'text',
            'attachments' => [
                [
                    'title' => 'title1',
                    'title_link' => '',
                    'text' => 'text1'
                ],
                [
                    'title' => 'title2',
                    'title_link' => '',
                    'text' => 'text2'
                ]
            ]
        ];
        $this->assertEquals($expected, $message->JsonSerialize());
    }
}
