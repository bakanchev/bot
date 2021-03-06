<?php

declare(strict_types=1);

namespace Tests\Classes;

use Faker\Factory;
use Faker\Generator;
use FondBot\Drivers\User;
use FondBot\Drivers\Driver;
use FondBot\Drivers\Command;
use FondBot\Drivers\ReceivedMessage;
use FondBot\Drivers\Exceptions\InvalidRequest;
use FondBot\Drivers\Extensions\WebhookVerification;

class TestDriver extends Driver implements WebhookVerification
{
    private $sender;
    private $message;

    /**
     * Configuration parameters.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return ['token'];
    }

    /**
     * Verify incoming request data.
     *
     * @throws InvalidRequest
     */
    public function verifyRequest(): void
    {
    }

    /**
     * Get message sender.
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->sender ??
            $this->sender = new User($this->faker()->uuid, $this->faker()->name, $this->faker()->userName);
    }

    /**
     * Get message received from sender.
     *
     * @return ReceivedMessage
     */
    public function getMessage(): ReceivedMessage
    {
        return $this->message;
    }

    /**
     * Handle command.
     *
     * @param Command $command
     */
    public function handle(Command $command): void
    {
        // TODO: Implement handle() method.
    }

    /**
     * Whether current request type is verification.
     *
     * @return bool
     */
    public function isVerificationRequest(): bool
    {
        return $this->hasRequest('verification');
    }

    /**
     * Run webhook verification and respond if required.
     *
     * @return mixed
     */
    public function verifyWebhook()
    {
        return $this->getRequest('verification');
    }

    private function faker(): Generator
    {
        return Factory::create();
    }
}
