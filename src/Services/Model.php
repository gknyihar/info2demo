<?php
namespace GKnyihar\Info2Demo\Services;

class Model
{
    protected static $table = "";

    public static function all()
    {
        $table = static::$table;
        $db = new DB("mysql:host=localhost;dbname=info2demo", "root", "");
        return $db->query("select * from {$table};", static::class);
    }
}