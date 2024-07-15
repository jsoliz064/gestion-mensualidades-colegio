<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::firstOrCreate(['name' => 'Admin']);
        $role2 = Role::firstOrCreate(['name' => 'Director']);
        $role3 = Role::firstOrCreate(['name' => 'Secretaria']);

        Permission::firstOrCreate(['name' => 'users.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'users.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'users.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'users.delete'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'roles.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'roles.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'roles.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'roles.delete'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'permissions.index'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'administrativos.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'administrativos.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'administrativos.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'administrativos.delete'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'estudiantes.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name' => 'estudiantes.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name' => 'estudiantes.edit'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name' => 'estudiantes.delete'])->syncRoles([$role1, $role2, $role3]);

        Permission::firstOrCreate(['name' => 'tutores.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name' => 'tutores.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name' => 'tutores.edit'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name' => 'tutores.delete'])->syncRoles([$role1, $role2, $role3]);

        Permission::firstOrCreate(['name' => 'cursos.index'])->syncRoles([$role1, $role2, $role3]);

        Permission::firstOrCreate(['name' => 'pagos.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::firstOrCreate(['name' => 'pagos.create'])->syncRoles([$role1, $role2, $role3]);
    }
}
