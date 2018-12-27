<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 23:20
 */

class TestCommandManager extends TestBase
{
    public function testCommandList() {
        $manager = new \PingCheng\SlackSlashCommand\CommandManager();

        // clear the commands array
        $this->clearCommandConfig();
        $this->assertEmpty($manager->loadCommandList());

        // load with one command in the list
        $this->loadSampleCommandConfig();

        // testing the list function
        $list = $manager->loadCommandList();
        $this->assertEquals(2, sizeof($list));
        $this->assertArrayHasKey('sample', $list);
        $this->assertArrayHasKey('channel', $list);
        $this->assertContains(TestingSampleCommand::class, $list);
    }

    public function testGetCommand() {
        $manager = new \PingCheng\SlackSlashCommand\CommandManager();
        $this->clearCommandConfig();
        $this->loadSampleCommandConfig();

        // testing get command class
        $command = $manager->getCommandClass('sample');
        $this->assertEquals(TestingSampleCommand::class, $command);

        // testing get command name by payload
        $command = $manager->getCommandFromPayLoad([
            'command' => '/sample'
        ]);
        $this->assertEquals('sample', $command);
    }
}