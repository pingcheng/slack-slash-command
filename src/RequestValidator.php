<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 22:24
 */

namespace PingCheng\SlackSlashCommand;

use Illuminate\Http\Request;
use PingCheng\SlackSlashCommand\Exceptions\InvalidHeadersException;

class RequestValidator
{

    static $version = 'v0';
    /**
     * @param Request $request
     *
     * @throws InvalidHeadersException
     */
    public static function validate(Request $request) {
        $body = $request->getContent();
        $timestamp = $request->header('X-Slack-Request-Timestamp');
        if (time() - $timestamp > 300) {
            throw new InvalidHeadersException("Invalid timestamp, too much gap");
        }

        $hash = self::generateSignature($body, $timestamp);
        $local_signature = static::$version . "={$hash}";
        // get the remote sign
        $remote_signature = $request->header('X-Slack-Signature');
        // check two signs, if not match, throw an error
        if ($remote_signature !== $local_signature) {
            throw new InvalidHeadersException("Invalid signature");
        }
    }

    public static function generateSignature($payload, $timestamp) {
        $version = static::$version;
        $secret = config('slackslashcommand.signing_secret');
        $sig_base_string = "{$version}:{$timestamp}:{$payload}";
        $hash = hash_hmac('sha256', $sig_base_string, $secret);

        return $hash;
    }
}