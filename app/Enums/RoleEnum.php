<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case SECURITY_GUARD = 'security_guard';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::STAFF => 'Staff',
            self::SECURITY_GUARD => 'Security Guard',
        };
    }

    public static function values(): array
    {
        return array_map(fn($role) => $role->value, self::cases());
    }
}
