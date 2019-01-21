<?php

use PingCheng\SlackSlashCommand\Exceptions\CommandNotFoundException;
use PingCheng\SlackSlashCommand\Exceptions\InvalidHeadersException;

/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2019-01-21
 * Time: 22:17
 */

class TestException extends TestBase
{
    public function testCommandNotFoundExceptionDefaultMessage() {
        try {
            throw new CommandNotFoundException();
        } catch (CommandNotFoundException $exception) {
            $this->assertEquals('Command is not found', $exception->getMessage());
            $this->assertEquals(400, $exception->getCode());
        }
    }

    public function testInvalidHeaderExceptionDefaultMessage() {
        try {
            throw new InvalidHeadersException();
        } catch (InvalidHeadersException $exception) {
            $this->assertEquals('', $exception->getMessage());
            $this->assertEquals(400, $exception->getCode());
        }
    }
}