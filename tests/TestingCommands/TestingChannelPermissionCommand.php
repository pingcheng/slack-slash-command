<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 23:40
 */

class TestingChannelPermissionCommand extends \PingCheng\SlackSlashCommand\SlackSlackCommand
{

    protected $limit_on_channel_ids = ['1234'];

    /**
     * need to be defined in the actual command class
     *
     * @return mixed
     */
    public function handle()
    {
        return 'pass';
    }
}