<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'title' => 'Programozás',
                'description' => 'Megtanulni PHP-ban programozni',
                'status' => 'done',
                'user_id' => 1
            ],
            [
                'title' => 'Laravel',
                'description' => 'Utánanézni a Laravel keretrendszernek',
                'status' => 'in_progress',
                'user_id' => 1
            ],
            [
                'title' => 'IDE',
                'description' => 'Fejlesztő környezet telepítése',
                'status' => 'new',
                'user_id' => 1
            ],
            [
                'title' => 'Architecture',
                'description' => 'Használni az alapvető architekturális mintákat',
                'status' => 'new',
                'user_id' => 1
            ],
            [
                'title' => 'HTML',
                'description' => 'Szemantikus HTML-t használni',
                'status' => 'done',
                'user_id' => 2
            ],
            [
                'title' => 'CSS',
                'description' => 'Kirpóbálni CSS keretrendszereket',
                'status' => 'new',
                'user_id' => 2
            ],
            [
                'title' => 'JS',
                'description' => 'Kód kiegészítése JS kóddal',
                'status' => 'new',
                'user_id' => 3
            ],
            [
                'title' => 'Frameworks',
                'description' => 'JS keretrendszereket gyűjteni',
                'status' => 'new',
                'user_id' => 3
            ],
            [
                'title' => 'Typescript',
                'description' => 'Refaktorálni typscriptre',
                'status' => 'new',
                'user_id' => 3
            ],
        ]);
    }
}
