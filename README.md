<p align="center">
    <img src="https://raw.githubusercontent.com/pingcheng/slack-slash-command/gh-pages/images/logo.png" width=478>
</p>
<p align="center">
    <img src="https://travis-ci.org/pingcheng/slack-slash-command.svg?branch=master">
    <img src='https://coveralls.io/repos/github/pingcheng/slack-slash-command/badge.svg?branch=master' alt='Coverage Status'>
    <img src="https://poser.pugx.org/pingcheng/slack-slash-command/v/stable">
    <img src="https://poser.pugx.org/pingcheng/slack-slash-command/license">
</p>

## Introduction

Slack Slash Command is a Laravel package that helps developer integrate the slash command to their Laravel applications. For more information about Slack slash command, please visit: https://api.slack.com/slash-commands.



## Installation

1. Slach Slash Command recommands using composer to handling the package control, use the following command to add this package to your project

   ```bash
   composer require pingcheng/slack-slash-command
   ```

2. Add service provider to ```config/app.php```

   ```
   PingCheng\SlackSlashCommand\SlackSlashCommandServiceProvider::class,
   ```

3. Publish config file

   ```bash
   php artisan vendor:publish --provider="PingCheng\SlackSlashCommand\SlackSlashCommandServiceProvider" --tag=config
   ```

4. Define your ```.env``` 

   ```shell
   SLACK_SIGNING_SECRET=*YOUR SLACK APP SIGNING SECRET*
   ```



## Your first slash command

update soon :kissing_smiling_eyes:

