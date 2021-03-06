<?php

declare(strict_types=1);

namespace FondBot\Queue;

use SuperClosure\Serializer;
use Zumba\JsonSerializer\JsonSerializer;

trait SerializesForQueue
{
    /**
     * Create payload.
     *
     * @param SerializableForQueue $serializable
     *
     * @return string
     */
    protected function serialize(SerializableForQueue $serializable): string
    {
        $serializer = new JsonSerializer(new Serializer());

        return $serializer->serialize($serializable);
    }

    /**
     * Get instance from payload.
     *
     * @param string $payload
     *
     * @return SerializableForQueue
     */
    protected function unserialize(string $payload): SerializableForQueue
    {
        $serializer = new JsonSerializer(new Serializer());

        return $serializer->unserialize($payload);
    }
}
