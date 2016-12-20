<?php

namespace JSHayes\SlackMessageBuilder;

class Field extends AttributeCollection
{
    /**
     * Creates a new field
     *
     * @param string $title
     *        The title of the field
     * @param string $value
     *        The value of the field
     */
    public function __construct(string $title, string $value)
    {
        $this->putItem('title', $title);
        $this->putItem('value', $value);
    }

    /**
     * Set the field to be short. This allows it to be displayed side by side.
     *
     * @return \JSHayes\SlackMessageBuilder\Field
     *         This Field instance
     */
    public function setShort(): Field
    {
        $this->putItem('short', true);
        return $this;
    }

    /**
     * Set the field to not be short. This makes this field take the entire line.
     *
     * @return \JSHayes\SlackMessageBuilder\Field
     *         This Field instance
     */
    public function setNotShort(): Field
    {
        $this->putItem('short', false);
        return $this;
    }
}
