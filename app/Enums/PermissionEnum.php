<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // ======================================= Users ========================================
    // CRUD
    case VIEW_USERS = 'view_users';
    case CREATE_USERS = 'create_users';
    case UPDATE_USERS = 'update_users';
    case DELETE_USERS = 'delete_users';

    // ======================================= Queues ========================================
    // CRUD
    case VIEW_QUEUES = 'view_queues';
    case CREATE_QUEUES = 'create_queues';
    case UPDATE_QUEUES = 'update_queues';
    case DELETE_QUEUES = 'delete_queues';

    // View Actions
    case UPDATE_QUEUES_STATUSES = 'update_queue_status';
    case MARK_DONE_QUEUES = 'mark_done_queue';
    case MARK_INQUIRED_QUEUES = 'mark_inquired_queue';
    case MARK_HOLD_QUEUES = 'mark_hold_queue';

    // Label for each permission
    public function label(): string
    {
        return match ($this) {
                //===== Users =====
                // CRUD
            self::VIEW_USERS => 'View Users',
            self::CREATE_USERS => 'Create Users',
            self::UPDATE_USERS => 'Update Users',
            self::DELETE_USERS => 'Delete Users',
                //===== Queues =====
                // CRUD
            self::VIEW_QUEUES => 'View Queues',
            self::CREATE_QUEUES => 'Create Queues',
            self::UPDATE_QUEUES => 'Update Queues',
            self::DELETE_QUEUES => 'Delete Queues',
                // Actions
            self::UPDATE_QUEUES_STATUSES => 'Update Queue Status',
            self::MARK_DONE_QUEUES => 'Mark Done Queue',
            self::MARK_INQUIRED_QUEUES => 'Mark Inquired Queue',
            self::MARK_HOLD_QUEUES => 'Mark Hold Queue',
        };
    }

    // Main groups for permissions
    public function group(): ?string
    {
        return match ($this) {
            self::VIEW_USERS,
            self::CREATE_USERS,
            self::UPDATE_USERS,
            self::DELETE_USERS => 'users',

            self::VIEW_QUEUES,
            self::CREATE_QUEUES,
            self::UPDATE_QUEUES,
            self::DELETE_QUEUES,
            self::UPDATE_QUEUES_STATUSES,
            self::MARK_DONE_QUEUES,
            self::MARK_INQUIRED_QUEUES,
            self::MARK_HOLD_QUEUES => 'queues',

            default => null,
        };
    }

    public function subgroup(): ?string
    {
        return match ($this) {
            self::UPDATE_QUEUES_STATUSES,
            self::MARK_DONE_QUEUES,
            self::MARK_INQUIRED_QUEUES,
            self::MARK_HOLD_QUEUES => 'view',

            default => null,
        };
    }
}
