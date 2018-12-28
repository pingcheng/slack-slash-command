<?php

namespace PingCheng\SlackSlashCommand;

use Illuminate\Notifications\Channels\SlackWebhookChannel;
use Illuminate\Notifications\Messages\SlackMessage;

class SlackMessageBuilder extends SlackWebhookChannel
{

    /**
     * SlackMessageBuilder constructor.
     *
     * override the parent construct
     */
    public function __construct()
    {

    }

    public static function build(SlackMessage $message) {
        $builder = new static();
        return $builder->buildJsonPayload($message);
    }
}