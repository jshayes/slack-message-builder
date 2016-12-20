<?php

namespace JSHayes\SlackMessageBuilder;

use DateTime;

class Attachment extends AttributeCollection
{
    /**
     * Set the fallback text that is displayed when the attachment cannot be rendered
     *
     * @param string $fallback
     *        The attachment fallback
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setFallback(string $text): Attachment
    {
        $this->putItem('fallback', $text);
        return $this;
    }

    /**
     * Set the colour of the attachment
     *
     * @param string $colour
     *        The attachment colour. This can be a hex code or one constants
     *        from \JSHayes\SlackMessageBuilder\Style
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setColour(string $colour): Attachment
    {
        $this->putItem('color', $colour);
        return $this;
    }

    /**
     * Set the text that is displayed above the attachment
     *
     * @param string $pretext
     *        The attachment pretext
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setPretext(string $text): Attachment
    {
        $this->putItem('pretext', $text);
        return $this;
    }

    /**
     * Set the author of the attachment
     *
     * @param string $name
     *        The author's name
     * @param string $link
     *        The url that the author's name points to
     * @param string $icon
     *        The icon to display for the author
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setAuthor(string $name, string $link = '', string $icon = ''): Attachment
    {
        $this->putItem('author_name', $name);
        $this->putItem('author_link', $link);
        $this->putItem('author_icon', $icon);
        return $this;
    }

    /**
     * Set the title of the attachment
     *
     * @param string $title
     *        The attachment title
     * @param string $link
     *        The attachment title link
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setTitle(string $title, string $link = ''): Attachment
    {
        $this->putItem('title', $title);
        $this->putItem('title_link', $link);
        return $this;
    }

    /**
     * Set the text for this attachment
     *
     * @param string $text
     *        The attachment text
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setText(string $text): Attachment
    {
        $this->putItem('text', $text);
        return $this;
    }

    /**
     * Set the image url for this attachment
     *
     * @param string $url
     *        The attachment image url
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setImage(string $url): Attachment
    {
        $this->putItem('image_url', $url);
        return $this;
    }

    /**
     * Set the thumb url for this attachment
     *
     * @param string $url
     *        The attachment thumb url
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setThumb(string $url): Attachment
    {
        $this->putItem('thumb_url', $url);
        return $this;
    }

    /**
     * Set the footer for the attachment
     *
     * @param string $text
     *        The attachment footer text
     * @param string $icon
     *        The attachment footer icon url
     * @param \DateTime $timestamp
     *        The attachment footer timestamp
     *
     * @return JSHayes\SlackMessageBuilder\Attachment
     *         This attachment instance
     */
    public function setFooter(string $text, string $icon = '', DateTime $datetime = null): Attachment
    {
        $this->putItem('footer', $text);
        $this->putItem('footer_icon', $icon);

        if (!is_null($datetime)) {
            $this->putItem('ts', $datetime->getTimestamp());
        }

        return $this;
    }

    /**
     * Add a field to this attachment
     *
     * @param string $title
     *        The title of the field
     * @param string $value
     *        The value of the field
     *
     * @return \JSHayes\SlackMessageBuilder\Field
     *         The newly added field
     */
    public function addField(string $title, string $value): Field
    {
        $field = new Field($title, $value);
        $this->appendItem('fields', $field);

        return $field;
    }

    /**
     * Add a button action to this attachment
     *
     * @param string $name
     *        The name of the button
     * @param string $text
     *        The display text for the button
     *
     * @return \JSHayes\SlackMessageBuilder\Button
     *         The newly created button
     */
    public function addButton(string $name, string $text): Button
    {
        $button = new Button($name, $text);
        $this->appendItem('actions', $button);

        return $button;
    }

    /**
     * Add a button action to this attachment with the primary style applied
     *
     * @param string $name
     *        The name of the button
     * @param string $text
     *        The display text for the button
     *
     * @return \JSHayes\SlackMessageBuilder\Button
     *         The newly created button
     */
    public function addPrimaryButton(string $name, string $text): Button
    {
        return $this->addButton($name, $text)
            ->setStyle(Style::PRIMARY);
    }

    /**
     * Add a button action to this attachment with the danger style applied
     *
     * @param string $name
     *        The name of the button
     * @param string $text
     *        The display text for the button
     *
     * @return \JSHayes\SlackMessageBuilder\Button
     *         The newly created button
     */
    public function addDangerButton(string $name, string $text): Button
    {
        return $this->addButton($name, $text)
            ->setStyle(Style::DANGER);
    }
}
