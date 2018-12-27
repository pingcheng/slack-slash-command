<?php
/**
 * Created by PhpStorm.
 * User: pingcheng
 * Date: 2018-12-27
 * Time: 22:24
 */

namespace PingCheng\SlackSlashCommand;


use Carbon\Carbon;
use Illuminate\Http\Request;
use PingCheng\SlackSlashCommand\Exceptions\InvalidHeadersException;

class RequestValidator
{
    /**
     * @param Request $request
     *
     * @throws InvalidHeadersException
     */
    public static function validate(Request $request) {
        // define the version number
        $version = 'v0';

        // load the secret, you also can load it from env(YOUR_OWN_SLACK_SECRET)
        $secret = config('slackslashcommand.signing_secret');

        // get the payload
        $body = $request->getContent();
        // get the timestamp
        // and compare with the local time, according to the slack official documents
        // the gap should under 5 minutes
        $timestamp = $request->header('X-Slack-Request-Timestamp');
        if (Carbon::now()->diffInMinutes(Carbon::createFromTimestamp($timestamp)) > 5) {
            throw new InvalidHeadersException("Invalid timestamp, too much gap");
        }
        // generate the string base
        $sig_base_string = "{$version}:{$timestamp}:{$body}";
        // generate the local sign
        $hash = hash_hmac('sha256', $sig_base_string, $secret);
        $local_signature = "{$version}={$hash}";
        // get the remote sign
        $remote_signature = $request->header('X-Slack-Signature');
        // check two signs, if not match, throw an error
        if ($remote_signature !== $local_signature) {
            throw new InvalidHeadersException("Invalid signature");
        }
    }
}