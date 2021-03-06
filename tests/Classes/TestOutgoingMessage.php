<?php

declare(strict_types=1);

namespace Tests\Classes;

use FondBot\Drivers\User;
use FondBot\Conversation\Keyboard;
use FondBot\Drivers\OutgoingMessage;

class TestOutgoingMessage implements OutgoingMessage
{
    private $recipient;
    private $text;
    private $keyboard;

    public function __construct(User $recipient, $text, Keyboard $keyboard = null)
    {
        $this->recipient = $recipient;
        $this->text = $text;
        $this->keyboard = $keyboard;
    }

    /**
     * Get receiver.
     *
     * @return User
     */
    public function getRecipient(): User
    {
        return $this->recipient;
    }

    /**
     * Get message text.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Get keyboard.
     *
     * @return Keyboard|null
     */
    public function getKeyboard(): ?Keyboard
    {
        return $this->keyboard;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'receiver' => $this->recipient->getId(),
            'text' => $this->text,
            'keyboard' => $this->keyboard,
        ];
    }
}
