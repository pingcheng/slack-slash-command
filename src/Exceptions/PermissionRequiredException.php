<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 15:33
 */

namespace PingCheng\SlackSlashCommand\Exceptions;


use Throwable;

class PermissionRequiredException extends \Exception
{
    public function __construct($message = "You do not have permission to execute this command", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}