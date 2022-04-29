<?php

namespace GKnyihar\Info2Demo\Models;

use GKnyihar\Info2Demo\Services\Model;

class User extends Model
{
    protected static $table = 'users';

    public $id;
    public $username;
    public $name;
    public $email;
}