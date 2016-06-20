<?php
namespace App\Libraries\BearyChat;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\Handler\Curl;

use GuzzleHttp\Client;

/**
 * Log Notice By Beary Chat
 *
 * Class BearyChatHandler
 * @package App\Libraries
 */
class BearyChatHandler extends AbstractProcessingHandler
{
    private $webhook;
    private $isOpen;

    public function __construct($level = Logger::NOTICE, $bubble = true)
    {
        $this->webhook = env('BEARYCHAT_ERROR_NOTICE_HOOK');
        $this->isOpen = env('BEARYCHAT_ERROR_NOTICE_OPEN', false);
        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record)
    {
        // 未开启
        if ($this->isOpen == false) {
            return ;
        }


        /**
         * send message to BearyChat
         */
        $client = new Client();

        // post data
        $data = [
            // format：time - level - hostname
            'text' => $record['datetime']->format('Y-m-d H:i:s') . ' - ' . $record["level_name"] . ' - ' . gethostname(),
            'notification' => 'Web Error Log',
            'attachments' => [
                [
                    // message title
                    'title' => current(preg_split("/([\n\r]+)/i", $record['message'])),

                    // 堆栈信息不输出出来
//                    'text' => $record['message'],

                    // error color
                    'color' => '#ff0000'
                ]
            ]
        ];

        // send
        $client->request('POST', $this->webhook, [
            'form_params' => ['payload' => json_encode($data)]
        ]);
    }
}