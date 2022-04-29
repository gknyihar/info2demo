<?php


namespace GKnyihar\Info2Demo\Models;


class Task extends Model
{
    protected static $table = 'tasks';

    public $title;
    public $description;
}