<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2019-02-03
 * Time: 16:13
 */

class TestCommandGetters extends TestBase
{
    protected $payload = [
        'token' => 'sample_token',
        'team_id' => 'sample_team_id',
        'team_domain' => 'sample_team_domain',
        'enterprise_id' => 'sample_enterprise_id',
        'enterprise_name' => 'sample_enterprise_name',
        'channel_id' => 'sample_channel_id',
        'channel_name' => 'sample_channel_name',
        'user_id' => 'sample_user_id',
        'user_name' => 'sample_user_name',
        'command' => 'sample_command',
        'text' => 'sample_text',
        'response_url' => 'sample_response_url',
        'trigger' => 'sample_trigger',
    ];

    protected function getSampleCommand()
    {
        return new TestingSampleSlashCommand($this->payload);
    }

    public function testTokenGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['token'], $command->getToken());
        $this->assertTrue(is_string($command->getToken()));
    }

    public function testTeamIdGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['team_id'], $command->getTeamId());
        $this->assertTrue(is_string($command->getTeamId()));
    }

    public function testTeamDomainGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['team_domain'], $command->getTeamDomain());
        $this->assertTrue(is_string($command->getTeamDomain()));
    }

    public function testEnterpriseIdGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['enterprise_id'], $command->getEnterpriseId());
        $this->assertTrue(is_string($command->getEnterpriseId()));
    }

    public function testEnterpriseNameGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['enterprise_name'], $command->getEnterpriseName());
        $this->assertTrue(is_string($command->getEnterpriseName()));
    }

    public function testChannelIdGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['channel_id'], $command->getChannelId());
        $this->assertTrue(is_string($command->getChannelId()));
    }

    public function testChannelNameGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['channel_name'], $command->getChannelName());
        $this->assertTrue(is_string($command->getChannelName()));
    }

    public function testUserIdGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['user_id'], $command->getUserId());
        $this->assertTrue(is_string($command->getUserId()));
    }

    public function testUserNameGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['user_name'], $command->getUserName());
        $this->assertTrue(is_string($command->getUserName()));
    }

    public function testCommandGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['command'], $command->getCommand());
        $this->assertTrue(is_string($command->getCommand()));
    }

    public function testTextGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['text'], $command->getText());
        $this->assertTrue(is_string($command->getText()));
    }

    public function testResponseUrlGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['response_url'], $command->getResponseUrl());
        $this->assertTrue(is_string($command->getResponseUrl()));
    }

    public function testTriggerGetter()
    {
        $command = $this->getSampleCommand();
        $this->assertEquals($this->payload['trigger'], $command->getTrigger());
        $this->assertTrue(is_string($command->getTrigger()));
    }
}