<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-29
 * Time: 22:33
 */

class TestingSlackMessageResponseSlashCommand extends PingCheng\SlackSlashCommand\SlackSlashCommand
{

    /**
     * need to be defined in the actual command class
     *
     * @return mixed
     */
    public function handle()
    {
        return (new \Illuminate\Notifications\Messages\SlackMessage())
            ->content('test response');
    }
}