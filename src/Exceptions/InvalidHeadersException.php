<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 22:26
 */

namespace PingCheng\SlackSlashCommand\Exceptions;


use Throwable;

class InvalidHeadersException extends \Exception
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}