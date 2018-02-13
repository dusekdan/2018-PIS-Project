<?php
namespace App\Services;


use App\Models\Role;

class RoleService
{
    private static $roleDisplayNames = [
        'kuchar' => 'Kuchař',
        'manager' => 'Manažer',
        'kancelar' => 'Kancelář',
        'obsluha' => 'Obsluha'
    ];

    public static function getUserRoleDisplayName($roleName)
    {
        return  (array_key_exists($roleName, self::$roleDisplayNames))
            ? self::$roleDisplayNames[$roleName]
            : 'Neexistující role';
    }

    public static function getAllRoles()
    {
        return Role::all();
    }
}