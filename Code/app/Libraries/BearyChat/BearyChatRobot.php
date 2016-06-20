<?php
namespace App\Libraries\BearyChat;

use GuzzleHttp\Client;

/**
 * Send Message To BearyChat
 *
 * Class BearyChatRobot
 * @package App\Libraries
 *
 * @example
 *      $notify_title   = '这是标题 - 周大哥';
        $notify_content = '这是内容 - 啊啊啊啊';
        App\Libraries\BearyChatRobot::notify($notify_title, $notify_content);
 */
class BearyChatRobot
{
    public static function notify($title, $content)
    {
        if (!env('BEARYCHAT_HOOK')) {
            return;
        }

        $client = new Client();

        $data                   = [];
        $data['text']           = $title;
        $data['attachments'][]  = ['text' => $content];

        $client->request('POST', env('BEARYCHAT_HOOK'), [
            'form_params' => ['payload' => json_encode($data)]
        ]);
    }
}