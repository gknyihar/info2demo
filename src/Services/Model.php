<?php

namespace GKnyihar\Info2Demo\Services;

class Model
{
    protected static $table = "";

    public static function all()
    {
        $table = static::$table;
        $db = new DB(config('db.connectionString'), config('db.username'), config('db.password'));
        return $db->query("select * from {$table};", static::class);
    }
}