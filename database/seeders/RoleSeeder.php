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
     */
    public function run(): void
    {
        //El sistema tendrá 2 tipos de Usuario
        //Administrador
        //Usuario Normal

        $admin = Role::create(['name' => 'admin']);
        $usuario = Role::create(['name' => 'usuario']);

        /*Permisos basados en los name de las rutas C:\wamp64\www\sisgestiondearchivos\routes\web.php */
        $permission = Permission::create(['name' => 'admin.index'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'usuarios.index'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'usuarios.create'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'usuarios.store'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'usuarios.show'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'usuarios.edit'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'usuarios.update'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'usuarios.destroy'])->syncRoles([$admin]);

        $permission = Permission::create(['name' => 'mi_unidad.index'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.store'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.carpeta'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.carpeta.update_subcarpeta'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.carpeta.update_subcarpeta_color'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.carpeta.crear_subcarpeta'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.update'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.update_color'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.carpeta.destroy'])->syncRoles([$admin,$usuario]);

        $permission = Permission::create(['name' => 'mi_unidad.archivo.upload'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.archivo.eliminar_archivos'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.archivo.cambiar.privado.publico'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mi_unidad.archivo.cambiar.publico.privado'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'mostrar.archivos.privados'])->syncRoles([$admin,$usuario]);
    }
}
