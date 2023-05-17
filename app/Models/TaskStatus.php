<?php

namespace App\Models;

use ReflectionClass;

class TaskStatus
{
    public const NEW = 'new';
    public const IN_PROGRESS = 'in_progress';
    public const DONE = 'done';

    public static function validate($status): bool
    {
        $constants = (new ReflectionClass(static::class))->getConstants();
        return in_array($status, $constants);
    }
}
