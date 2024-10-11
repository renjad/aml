<?php

namespace App\Enums;

enum QueueStatusEnum: string
{
    case WAITING = 'waiting';
    case CALLING = 'calling';
    case SERVING = 'serving';
    case SERVED = 'served';
    case INQUIRED = 'inquired';
    case HOLD = 'hold';
}
