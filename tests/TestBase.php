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
            'sample' => TestingSampleCommand::class,
            'channel' => TestingChannelPermissionCommand::class,
        ]]);
    }

    protected function getManager() {
        return new \PingCheng\SlackSlashCommand\CommandManager();
    }

    public function testFilling() {
        $this->assertTrue(true);
    }
}