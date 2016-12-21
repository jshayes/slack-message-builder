<?php

namespace JSHayes\SlackMessageBuilder;

class Message extends AttributeCollection
{
    /**
     * Create a new message
     *
     * @param string $text
     *        The text to display for this message
     */
    public function __construct(string $text = '')
    {
        $this->putItem('text', $text);
    }

    /**
     * Set the username for this message
     *
     * @param string $username
     *        The username for the message
     *
     * @return \JSHayes\SlackMessageBuilder\Message
     *         This message instance
     */
    public function setUsername(string $username): Message
    {
        $this->putItem('username', $username);
        return $this;
    }

    /**
     * Set the channel name for this message
     *
     * @param string $channel
     *        The channel name for the message
     *
     * @return \JSHayes\SlackMessageBuilder\Message
     *         This message instance
     */
    public function setChannel(string $channel): Message
    {
        $this->putItem('channel', $channel);
        return $this;
    }

    /**
     * Set the username of the recipient of this message
     *
     * @param string $username
     *        The username of the recipient
     *
     * @return \JSHayes\SlackMessageBuilder\Message
     *         This message instance
     */
    public function setRecipient(string $username): Message
    {
        $this->putItem('channel', '@' . $username);
        return $this;
    }

    /**
     * Add an attachment to this message
     *
     * @param string $title
     *        The title of the attachment
     * @param string $text
     *        The text of the attachment
     *
     * @return \JSHayes\SlackMessageBuilder\Attachment
     *         The newly created attachment
     */
    public function addAttachment(string $title = '', string $text = ''): Attachment
    {
        $attachment = new Attachment();
        $this->appendItem('attachments', $attachment);

        return $attachment
            ->setTitle($title)
            ->setText($text);
    }
}
