<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 14:46
 */

namespace PingCheng\SlackSlashCommand\Exceptions;


use Throwable;

class CommandNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        if ($message === '') {
            $message = 'Command is not found';
        }

        parent::__construct($message, $code, $previous);
    }
}