<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 23:36
 */

class TestingCommand extends TestBase
{
    public function testSampleCommand() {
        $this->clearCommandConfig();
        $this->loadSampleCommandConfig();
        $manager = new \PingCheng\SlackSlashCommand\CommandManager();

        $result = $manager->process([
            'command' => '/sample'
        ]);

        $this->assertEquals('Testing sample command', $result);
    }

    public function testUndefinedCommand() {
        $this->clearCommandConfig();
        $manager = new \PingCheng\SlackSlashCommand\CommandManager();
        $this->expectException(\PingCheng\SlackSlashCommand\Exceptions\CommandNotFoundException::class);
        $this->expectExceptionCode(400);

        $manager->process([
            'command' => '/random'
        ]);
    }

    public function testChannelIdPassCommand() {
        $this->clearCommandConfig();
        $this->loadSampleCommandConfig();
        $manager = $this->getManager();

        $result = $manager->process([
            'command' => '/channel',
            'channel_id' => 1234,
        ]);

        $this->assertEquals('pass', $result);
    }

    public function testChannelIdDenyCommand() {
        $this->clearCommandConfig();
        $this->loadSampleCommandConfig();
        $manager = $this->getManager();
        $this->expectException(\PingCheng\SlackSlashCommand\Exceptions\PermissionRequiredException::class);
        $this->expectExceptionCode(403);

        $manager->process([
            'command' => '/channel',
            'channel_id' => 1232,
        ]);
    }

    public function testUserIdPassCommand() {
        $this->clearCommandConfig();
        $this->loadTestingCommandConfig();
        $manager = $this->getManager();

        $result = $manager->process([
            'command' => '/user_permission',
            'user_id' => 1234,
        ]);

        $this->assertEquals('pass', $result);
    }

    public function testUserIdDenyCommand() {
        $this->clearCommandConfig();
        $this->loadTestingCommandConfig();
        $this->expectException(\PingCheng\SlackSlashCommand\Exceptions\PermissionRequiredException::class);
        $this->expectExceptionCode(403);
        $manager = $this->getManager();

        $manager->process([
            'command' => '/user_permission',
        ]);
    }

    public function testSlackMessageResponseCommand() {
        $this->clearCommandConfig();
        $this->loadTestingCommandConfig();
        $manager = $this->getManager();

        $response = $manager->process([
            'command' => '/slack_message_response',
        ]);

        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('text', $response);
        $this->assertArrayHasKey('attachments', $response);
        $this->assertEquals('test response', $response['text']);
        $this->assertEquals([], $response['attachments']);
    }
}