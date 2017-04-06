<?php

declare(strict_types=1);

namespace FondBot\Drivers;

use FondBot\Helpers\Arr;
use FondBot\Drivers\Exceptions\InvalidRequest;
use FondBot\Queue\SerializableForQueue;

abstract class Driver implements SerializableForQueue
{
    /** @var array */
    private $request = [];

    /** @var array */
    private $headers = [];

    /** @var array */
    private $parameters;

    /**
     * Set driver data.
     *
     * @param array $parameters
     * @param array $request
     * @param array $headers
     */
    public function fill(array $parameters, array $request = [], array $headers = []): void
    {
        $this->parameters = $parameters;
        $this->request = $request;
        $this->headers = $headers;
    }

    /**
     * Get request value.
     *
     * @param string|null $key
     *
     * @return mixed
     */
    public function getRequest(string $key = null)
    {
        return Arr::get($this->request, $key);
    }

    /**
     * If request has key.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasRequest(string $key): bool
    {
        return Arr::has($this->request, [$key]);
    }

    /**
     * Get all headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Get header.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getHeader(string $name)
    {
        return Arr::get($this->headers, $name);
    }

    /**
     * Get parameter value.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getParameter(string $name)
    {
        return Arr::get($this->parameters, $name);
    }

    /**
     * Configuration parameters.
     *
     * @return array
     */
    abstract public function getConfig(): array;

    /**
     * Verify incoming request data.
     *
     * @throws InvalidRequest
     */
    abstract public function verifyRequest(): void;

    /**
     * Get user.
     *
     * @return User
     */
    abstract public function getUser(): User;

    /**
     * Get message received from sender.
     *
     * @return ReceivedMessage
     */
    abstract public function getMessage(): ReceivedMessage;

    /**
     * Handle command.
     *
     * @param Command $command
     */
    abstract public function handle(Command $command): void;
}
