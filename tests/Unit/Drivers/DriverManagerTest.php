<?php

declare(strict_types=1);

namespace Tests\Unit\Drivers;

use Tests\TestCase;
use FondBot\Helpers\Str;
use FondBot\Channels\Channel;
use FondBot\Drivers\DriverManager;
use Tests\Classes\TestDriver;

/**
 * @property DriverManager manager
 */
class DriverManagerTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->manager = new DriverManager();
        $this->manager->add('fake', new TestDriver());
    }

    public function test_get()
    {
        $channel = new Channel('test', 'fake', ['token' => Str::random()]);

        $driver = $this->manager->get($channel);

        $this->assertInstanceOf(TestDriver::class, $driver);
    }

    /**
     * @expectedException \FondBot\Drivers\Exceptions\InvalidConfiguration
     * @expectedExceptionMessage Invalid `test` channel configuration.
     */
    public function test_get_invalid_configuration()
    {
        $channel = new Channel('test', 'fake', ['old' => Str::random()]);

        $this->manager->get($channel);
    }
}
