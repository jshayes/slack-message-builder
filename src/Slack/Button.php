<?php

namespace JSHayes\SlackMessageBuilder;

use Illuminate\Support\Collection;

class Button extends AttributeCollection
{
    /**
     * Create a new button with the require values
     *
     * @param string $name
     *        The name of the button
     * @param string $text
     *        The display text for the button
     */
    public function __construct(string $name, string $text)
    {
        $this->putItem('type', 'button');
        $this->putItem('name', $name);
        $this->putItem('text', $text);
    }

    /**
     * Set the style of the button
     *
     * @param string $style
     *        The button style
     *
     * @return \JSHayes\SlackMessageBuilder\Button
     *         This button instance
     */
    public function setStyle(string $style): Button
    {
        $this->putItem('style', $style);
        return $this;
    }

    /**
     * Set the value for the button that identifies this button
     *
     * @param string $value
     *        The button value
     *
     * @return \JSHayes\SlackMessageBuilder\Button
     *         This button instance
     */
    public function setValue(string $value): Button
    {
        $this->putItem('value', $value);
        return $this;
    }

    /**
     * Set the confirmation fields for this button
     *
     * @param string $title
     *        The confirmation title
     * @param string $text
     *        The confirmation text
     * @param string $okText
     *        The ok button text
     * @param string $dismissText
     *        The dismiss button text
     *
     * @return \JSHayes\SlackMessageBuilder\Button
     *         This button instance
     */
    public function setConfirmationFields(
        string $title,
        string $text,
        string $okText = '',
        string $dismissText = ''
    ): Button {
        $confirmationFields = new Collection([
            'title' => $title,
            'text' => $text,
            'ok_text' => $okText,
            'dismiss_text' => $dismissText
        ]);

        $confirmationFields = $confirmationFields->filter(function ($value) {
            return !empty($value);
        });

        $this->putItem('confirm', $confirmationFields);
        return $this;
    }
}
