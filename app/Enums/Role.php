<?php
 
namespace App\Enums;
 
use Rexlabs\Enum\Enum;
 
/**
 * The Role enum.
 *
 * @method static self ADMIN()
 */
class Role extends Enum
{
    const ADMIN = 'admin';

    /**
     * Retrieve a map of enum keys and values.
     *
     * @return array
     */
    public static function map() : array
    {
        return [
            static::ADMIN => 'Admin',
        ];
    }

}