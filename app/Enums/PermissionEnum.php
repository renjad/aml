<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case VIEW_QUEUES = 'view queues';
    case CREATE_QUEUES = 'create queues';
    case EDIT_QUEUES = 'edit queues';
    case DELETE_QUEUES = 'delete queues';
    case UPDATE_QUEUES_STATUSES = 'update queue status';
    case MARK_DONE_QUEUES = 'mark done queue';
    case MARK_INQUIRED_QUEUES = 'mark inquired queue';
    case MARK_HOLD_QUEUES = 'mark hold queue';

    public function label(): string
    {
        return match ($this) {
            self::VIEW_QUEUES => 'View Queues',
            self::CREATE_QUEUES => 'Create Queues',
            self::EDIT_QUEUES => 'Edit Queues',
            self::DELETE_QUEUES => 'Delete Queues',
            self::UPDATE_QUEUES_STATUSES => 'Update Queue Status',
            self::MARK_DONE_QUEUES => 'Mark Done Queue',
            self::MARK_INQUIRED_QUEUES => 'Mark Inquired Queue',
            self::MARK_HOLD_QUEUES => 'Mark Hold Queue',
        };
    }
}
