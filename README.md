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

1. Slach Slash Command recommends using composer to handling the package control, use the following command to add this package to your project

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

1. Create your command extends from ```PingCheng\SlackSlashCommand\SlackSlashCommand```

   ```php
   <?php
   
   namespace App\Slack\Commands;
   
   use Illuminate\Notifications\Messages\SlackMessage;
   use PingCheng\SlackSlashCommand\SlackSlashCommand;
   
   class SampleCommand extends SlackSlashCommand
   {
       public function handle() {
           // process your command logic here...
   
           // you can return plain text as the response
           // return "Hi, I received your slash command";
   
           // or, you can return a Laravel Slack Message object
           return (new SlackMessage)
               ->success()
               ->content("Got your slash command! :smirk:")
               ->attachment(function ($attachment) {
                   $attachment->title('Details')
                       ->fields([
                           'Username' => $this->user_name,
                           'User ID' => $this->user_id,
                           'Channel Name' => $this->channel_name,
                           'Channel ID' => $this->channel_id,
                       ]);
               });
       }
   }
   ```

2. Edit config file ```config/slackslashcommand.php```

   ```php
   <?php
   
   return [
       
       // the collection of your slack command
       // the array key is the command name (defined in your slack app console)
       'commands' => [
           'greeting' => \App\Slack\Commands\SampleCommand::class,
       ],
   
       'signing_secret' => env('SLACK_SIGNING_SECRET'),
   ];
   ```

3. Create a controller for your slack slash command

   ```php
   <?php
   
   namespace App\Http\Controllers;
   
   use PingCheng\SlackSlashCommand\CommandManager;
   use PingCheng\SlackSlashCommand\Exceptions\CommandNotFoundException;
   use PingCheng\SlackSlashCommand\Exceptions\InvalidHeadersException;
   
   class SlackController extends Controller
   {
       public function slashCommand() {
           try {
               // simple run CommandManager::run()
               // the manager would check the command list
               // and run the related command
               return CommandManager::run();
           } catch (CommandNotFoundException $e) {
               // would trigger if the command is not found
               return $e->getMessage();
           } catch (InvalidHeadersException $e) {
               // would trigger if the slack verfication is failed to meet
               return $e->getMessage();
           }
       }
   }
   ```

4. Add route to your ```routes/web.php``` or ```routes/api.php```

   ```php
   // You can define your own route
   Route::post('slack/slashcommand', 'SlackController@slashCommand');
   ```



## Permission control

You can easily control your slash command accessibility

### Via Channel ID

```php
class SampleCommand extends SlackSlashCommand
{
    // accepts array, only defined channel ids are allowed to execute this command
    protected $limit_on_channel_ids = ['channel_id_1', 'channel_id_2'];
    
    public function handle() {
        // command handler
    }
}
```

### Via User ID

```php
class SampleCommand extends SlackSlashCommand
{
    // accepts array, only defined user ids are allowed to execute this command
protected $limit_on_user_ids = ['user_id_1', 'user_id_2'];
    
    public function handle() {
        // command handler
    }
}
```



## Questions?

If you have any questions, please email me ping.che@hotmail.com or leave an issue, I would respond as soon as possible :smile: