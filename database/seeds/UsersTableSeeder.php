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
            'name' => 'Deivid Criollo',
            'email' => 'david.criollo14@gmail.com',
            'password' => Hash ::make('mensajeria.*'),
        ]);
        $user->assignRole('DECE');
    }
}
