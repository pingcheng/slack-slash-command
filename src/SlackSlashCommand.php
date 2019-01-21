<?php

namespace PingCheng\SlackSlashCommand;

use PingCheng\SlackSlashCommand\Exceptions\PermissionRequiredException;

abstract class SlackSlashCommand
{
    /*
     * Payload from slack
     */
    protected $token;
    protected $team_id;
    protected $team_domain;
    protected $enterprise_id;
    protected $enterprise_name;
    protected $channel_id;
    protected $channel_name;
    protected $user_id;
    protected $user_name;
    protected $command;
    protected $text;
    protected $response_url;
    protected $trigger;

    protected $limit_on_channel_ids = [];
    protected $limit_on_user_ids = [];

    /**
     * need to be defined in the actual command class
     *
     * @return mixed
     */
    abstract public function handle();

    /**
     * SlackSlashCommand constructor.
     *
     * @param $payload
     *
     * @throws PermissionRequiredException
     */
    public function __construct($payload)
    {
        $this->loadPayload($payload);
        $this->checkPermissions();
    }

    /**
     * check the command permission
     *
     * @throws PermissionRequiredException
     */
    protected function checkPermissions() {
        if (!empty($this->limit_on_channel_ids)) {
            if (!in_array($this->channel_id, $this->limit_on_channel_ids)) {
                throw new PermissionRequiredException();
            }
        }

        if (!empty($this->limit_on_user_ids)) {
            if (!in_array($this->user_id, $this->limit_on_user_ids)) {
                throw new PermissionRequiredException();
            }
        }
    }

    /**
     * process the payload
     *
     * @param $payload
     */
    protected function loadPayload($payload) {
        $fillable = ['token', 'team_id', 'team_domain', 'enterprise_id', 'enterprise_name', 'channel_id', 'channel_name', 'user_id', 'user_name', 'command', 'text', 'response_url', 'trigger'];
        foreach ($payload as $key => $value) {
            if (in_array($key, $fillable) && property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}