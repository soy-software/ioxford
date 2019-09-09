<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleDece = Role::create(['name' => 'DECE']);
        Role::create(['name' => 'ESTUDIANTE']);
        Permission::create(['name' => 'Períodos']);
        Permission::create(['name' => 'Preparatoría']);
        Permission::create(['name' => 'Básica elemental']);
        Permission::create(['name' => 'Básica media']);
        Permission::create(['name' => 'Básica superior']);
        Permission::create(['name' => 'Bachillerato']);
        Permission::create(['name' => 'Noticias']);
        Permission::create(['name' => 'Usuarios']);

        

        $role=Role::findByName('DECE');
        $role->syncPermissions(Permission::all());
    }
}
