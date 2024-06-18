<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Empleado']);
        
        Permission::create(['name' => 'admin.dashboard',
                            'description' => 'Ver tablero'])->syncRoles([$role1, $role2]);

        // Archivos de Páginas
        Permission::create(['name' => 'admin.paginas.archivos',
                            'description' => 'Ver listado archivos de páginas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.paginas-archivos.create',
                            'description' => 'Crear archivos de páginas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.paginas.archivos.edit',
                            'description' => 'Editar archivos de páginas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.paginas.archivos.destroy',
                            'description' => 'Eliminar archivos de páginas'])->syncRoles([$role1]);

        // Paginas
        Permission::create(['name' => 'admin.paginas.index',
                            'description' => 'Ver listado de páginas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.paginas.create',
                            'description' => 'Crear página'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.paginas.edit',
                            'description' => 'Editar página'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.paginas.destroy',
                            'description' => 'Eliminar página'])->syncRoles([$role1]);

        // Menu
        Permission::create(['name' => 'admin.menus.index',
                            'description' => 'Listado de menús'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.menus.create',
                            'description' => 'Crear menú'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.menus.edit',
                            'description' => 'Editar menú'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.menus.destroy',
                            'description' => 'Eliminar menú'])->syncRoles([$role1]);

        // Usuarios
        Permission::create(['name' => 'admin.users.index',
                            'description' => 'Listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create',
                            'description' => 'Crear usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit',
                            'description' => 'Editar usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.destroy',
                            'description' => 'Eliminar usuario'])->syncRoles([$role1]);
        
        // Footer
        Permission::create(['name' => 'admin.footers.index',
                            'description' => 'Listado de footer'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.footers.create',
                            'description' => 'Crear footer'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.footers.edit',
                            'description' => 'Editar footer'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.footers.destroy',
                            'description' => 'Eliminar footer'])->syncRoles([$role1]);

        // Roles y permisos
        Permission::create(['name' => 'admin.roles.index',
                            'description' => 'Listado de roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create',
                            'description' => 'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit',
                            'description' => 'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy',
                            'description' => 'Eliminar roles'])->syncRoles([$role1]);

        // Secciones páginas internas
        Permission::create(['name' => 'admin.paginas.pagina-seccion-index',
                            'description' => 'Listado de secciones de páginas'])->syncRoles([$role1]);

        // Subsecciones páginas internas
        Permission::create(['name' => 'admin.paginas.pagina-subseccion-index',
                            'description' => 'Listado de subsecciones de páginas'])->syncRoles([$role1]);
    }
}
