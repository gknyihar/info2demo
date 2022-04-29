<?php


namespace GKnyihar\Info2Demo\Models;


use GKnyihar\Info2Demo\Services\DB;

class Model
{
    protected static $table = "";

    public static function all()
    {
        $db = new DB(config('db.connectionString'), config('db.username'), config('db.password'));
        return $db->query("select * from {static::table};", static::class);
    }
}