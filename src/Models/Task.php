<?php

namespace GKnyihar\Info2Demo\Models;

use GKnyihar\Info2Demo\Services\Model;

class Task extends Model
{
    protected static $table = 'tasks';

    public $id;
    public $title;
    public $description;
}