<?php

namespace Tactician\CommandBus\Tests\Exception;

use League\Tactician\Exception\InvalidCommandException;
use League\Tactician\Exception\Exception;

class InvalidCommandExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionContainsDebuggingInfo()
    {
        $command = 'must be an object';

        $exception = InvalidCommandException::forUnknownValue($command);

        $this->assertContains('type: string', $exception->getMessage());
        $this->assertSame($command, $exception->getInvalidCommand());
        $this->assertInstanceOf(Exception::class, $exception);
    }
}
