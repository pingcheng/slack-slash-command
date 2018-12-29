<?php

namespace PingCheng\SlackSlashCommand;

class SlackSlashCommandServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/slackslashcommand.php' => config_path('slackslashcommand.php'),
        ], 'config');
    }

    public function register() {
        $this->app->singleton('slackslashcommand', function() {
            return new CommandManager;
        });
    }
}