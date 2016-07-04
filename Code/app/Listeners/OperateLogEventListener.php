<?php

namespace App\Listeners;

use App\Events\Event;
use App\OperateLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OperateLogEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginEvent  $event
     * @return void
     */
    public function handle(Event $event)
    {
        // 记录操作日志
        OperateLog::create($event->operateLog);
    }
}
