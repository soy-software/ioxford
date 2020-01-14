<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use iouesa\User;

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
            'name' => 'Administrador',
            'email' => 'info.uesfa@gmail.com',
            'password' => Hash ::make('info.uesfa@2020'),
        ]);
        $user->assignRole('DECE');
    }
}
