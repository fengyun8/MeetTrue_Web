<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;

class ResetPasswordEvent extends Event
{
    use SerializesModels;

    // Operator Log使用的变量
    public $operateLog;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $type, Array $extraArr)
    {
        // Get Request instance
        $request = request();

        // Operate Log Data
        $this->operateLog['operator_id'] = $user['id'];
        $this->operateLog['user_id'] = $user['id'];
        $this->operateLog['type'] = $type;
        $this->operateLog['ip'] = $request->ip();
        $this->operateLog['extra'] = json_encode($extraArr, true);     // 存储的额外信息
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
