<?php

namespace PingCheng\SlackSlashCommand;

use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\SlackMessage;
use PingCheng\SlackSlashCommand\Exceptions\CommandNotFoundException;

class CommandManager
{

    /**
     * find the related command class
     * and then execute it
     *
     * @param Request $request
     *
     * @return mixed
     */
    public static function run(Request $request = null) {
        $manager = new static();

        if ($request === null) {
            $request = request();
        }

        $manager->validate($request);
        return $manager->process($request->all());
    }

    /**
     *
     * @param $payload
     *
     * @return mixed
     * @throws CommandNotFoundException
     */
    public function process($payload) {
        $command_name = $this->getCommandFromPayLoad($payload);
        $command_class = $this->getCommandClass($command_name);

        if ($command_class === null) {
            throw new CommandNotFoundException("Command {$command_name} is not found");
        }

        /* @var \PingCheng\SlackSlashCommand\SlackSlackCommand $command */
        $command = new $command_class($payload);
        $result = $command->handle();

        // parse to json format if the result is a SlackMessage
        if (is_a($result, SlackMessage::class)) {
            $result = SlackMessageBuilder::build($result);
        }

        return $result;
    }

    /**
     * @param Request $request
     *
     * @throws Exceptions\InvalidHeadersException
     */
    public function validate(Request $request) {
        RequestValidator::validate($request);
    }

    /**
     * load the command list from the config file
     *
     * @return mixed
     */
    public function loadCommandList() {
        return config('slackslashcommand.commands');
    }

    /**
     * get the command class name based on the command name
     *
     * @param $command
     *
     * @return string|null
     */
    public function getCommandClass($command) {
        $commands = $this->loadCommandList();

        if (isset($commands[$command])) {
            return $commands[$command];
        }

        return null;
    }

    /**
     * get the command name from the slack payload
     *
     * @param $payload
     *
     * @return string
     */
    public function getCommandFromPayLoad($payload) {
        return ltrim($payload['command'], '/');
    }
}