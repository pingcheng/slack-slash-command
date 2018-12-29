<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-29
 * Time: 22:40
 */

class TestingUserPermissionSlashCommand extends \PingCheng\SlackSlashCommand\SlackSlashCommand
{

    protected $limit_on_user_ids = ['1234'];

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