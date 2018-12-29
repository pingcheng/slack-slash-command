<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 23:31
 */

class TestBase extends \Tests\TestCase
{
    protected function clearCommandConfig() {
        config(['slackslashcommand.commands' => []]);
    }

    protected function loadSampleCommandConfig() {
        config(['slackslashcommand.commands' => [
            'sample' => TestingSampleSlashCommand::class,
            'channel' => TestingChannelPermissionSlashCommand::class,
        ]]);
    }

    protected function loadTestingCommandConfig() {
        config(['slackslashcommand.commands' => [
            'user_permission' => TestingUserPermissionSlashCommand::class,
            'slack_message_response' => TestingSlackMessageResponseSlashCommand::class,
        ]]);
    }

    protected function getManager() {
        return new \PingCheng\SlackSlashCommand\CommandManager();
    }

    public function testFilling() {
        $this->assertTrue(true);
    }
}