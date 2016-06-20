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

    public function __construct($level = Logger::NOTICE, $bubble = true)
    {
        $this->webhook = env('BEARYCHAT_ERROR_HOOK');
        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record)
    {
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