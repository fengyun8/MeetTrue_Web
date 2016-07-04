<?php

namespace App\Events;

use App\Enums\OperateLogTypeEnum;
use App\Events\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LoginEvent extends Event
{
    use SerializesModels;

    // Operator Log使用的变量
    public $operateLog;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        // Get Request instance
        $request = request();

        // Operate Log Data
        $this->operateLog['operator_id'] = $user['id'];
        $this->operateLog['user_id'] = $user['id'];
        $this->operateLog['type'] = OperateLogTypeEnum::LOGIN;
        $this->operateLog['ip'] = $request->ip();
        // TODO 可以记录登陆的方式，Mobile / Email / Wechat等
//        $this->operateLog['extra'] = $request->all();     // 不要包含敏感的数据
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
