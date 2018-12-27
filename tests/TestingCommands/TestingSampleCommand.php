<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 23:25
 */

class TestingSampleCommand extends \PingCheng\SlackSlashCommand\SlackSlackCommand
{

    /**
     * need to be defined in the actual command class
     *
     * @return mixed
     */
    public function handle()
    {
        return "Testing sample command";
    }
}