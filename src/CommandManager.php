<?php

namespace PingCheng\SlackSlashCommand;

use PingCheng\SlackSlashCommand\Exceptions\CommandNotFoundException;
use PingCheng\SlackSlashCommand\Exceptions\PermissionRequiredException;

class CommandManager
{
    /**
     * @param $payload
     *
     * @throws CommandNotFoundException
     */
    public static function run($payload) {
        $manager = new static();

        $command_name = $manager->getCommandFromPayLoad($payload);
        $command_class = $manager->getCommandClass($command_name);

        if ($command_class === null) {
            throw new CommandNotFoundException("Command {$command_name} is not found");
        }

        /* @var \PingCheng\SlackSlashCommand\SlackSlackCommand $command */
        $command = new $command_class($payload);
        $command->handle();
    }

    public function loadCommandList() {
        return config('slackslashcommand.commands');
    }

    public function getCommandClass($command) {
        $commands = $this->loadCommandList();

        if (isset($commands[$command])) {
            return $commands[$command];
        }

        return null;
    }

    public function getCommandFromPayLoad($payload) {
        return ltrim($payload['command'], '/');
    }
}