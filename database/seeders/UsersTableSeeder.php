<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'firstname' => 'Екатерина',
            'secondname' => 'Юнева',
            'patronymic' => 'Петровна',
            'phone_number' => '+79603469551',
            'email' => 'katya_yuneva@mail.ru',
            'password' => Hash::make('qwerty'),
            'departament_id' => '1'
        ]);
    }
}
