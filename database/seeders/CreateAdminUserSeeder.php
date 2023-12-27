<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nroDocIdentificacion' => '1721154498',
            'sede' => 'Ecuador',
            'Apellido' => 'Ocaña',
            'name' => 'Dennis',
            'tlfContacto' => '0996389675',
            'email' => 'test@example.com',
            'emailRackspace' => 'test@rackspace.com',
            'fullTime' => '1',
            'categoria' => 'CSI',
            'horario' => '8:00-16"00',
            'username' => 'TeamLeader',
            'password' => 'TeamLeader'
        ]);

        $role = Role::create(['name' => 'TeamLeader']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}