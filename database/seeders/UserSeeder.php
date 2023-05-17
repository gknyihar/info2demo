<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'evelin123',
                'name' => 'Nagy Evelin',
                'email' => 'evelin123@gmail.com'
            ],
            [
                'id' => 2,
                'username' => 'kbalint',
                'name' => 'Kovács Bálint',
                'email' => 'kbalint@yahoo.com'
            ],
            [
                'id' => 3,
                'username' => 'vajan',
                'name' => 'Varga János',
                'email' => 'vajan@freemail.hu'
            ]
        ]);
    }
}
