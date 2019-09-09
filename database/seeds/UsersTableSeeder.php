<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use ioxford\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =User::create([
            'name' => 'Fransico Coque',
            'email' => 'david.criollo14@gmail.com',
            'password' => Hash ::make('12345678'),
        ]);
        $user->assignRole('DECE');
    }
}
