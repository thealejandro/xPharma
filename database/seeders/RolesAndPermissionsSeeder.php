<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

// class RolesAndPermissionsSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

//         // Create permissions
//         // Permisos generales
//         $permisos = [
//             'ver_inventario',
//             'ver_vencimientos',
//             'ver_productos',
//             'ver_compras',
//             'crear_compras',
//             'ver_ventas',
//             'realizar_venta',
//             'devolver_venta',
//             'hacer_cierre',
//             'ver_envios',
//             'crear_envios',
//             'aprobar_envios',
//             'ver_reportes',
//             'configuracion_sistema',
//         ];

//         foreach ($permisos as $permiso) {
//             Permission::firstOrCreate(['name' => $permiso]);
//         }

//         // Create roles
//         // Roles generales
//         $admin = Role::firstOrCreate(['name' => 'Administrador']);
//         $asistente = Role::firstOrCreate(['name' => 'Asistente']);
//         $encargado = Role::firstOrCreate(['name' => 'Encargado']);
//         $vendedor = Role::firstOrCreate(['name' => 'Vendedor']);

//         // Assign permissions to roles
//         // Permisos por rol

//         $admin->givePermissionTo(Permission::all());

//         $asistente->givePermissionTo([
//             'ver_compras',
//             'crear_compras',
//             'ver_envios',
//             'crear_envios',
//             'aprobar_envios',
//             'ver_reportes',
//         ]);

//         $encargado->givePermissionTo([
//             'ver_inventario',
//             'ver_vencimientos',
//             'ver_productos',
//             'ver_compras',
//             'ver_ventas',
//             'realizar_venta',
//             'devolver_venta',
//             'hacer_cierre',
//             'ver_envios',
//         ]);

//         $vendedor->givePermissionTo([
//             'ver_productos',
//             'ver_inventario',
//             'realizar_venta',
//             'ver_ventas',
//         ]);

//     }
// }

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET search_path TO public'); // necesario para Supabase/PostgreSQL

        $permisos = [
            'ver_inventario',
            'ver_vencimientos',
            'ver_productos',
            'ver_compras',
            'crear_compras',
            'ver_ventas',
            'realizar_venta',
            'devolver_venta',
            'hacer_cierre',
            'ver_envios',
            'crear_envios',
            'aprobar_envios',
            'ver_reportes',
            'configuracion_sistema',
        ];

        foreach ($permisos as $permiso) {
            try {
                DB::table('permissions')->updateOrInsert(
                    ['name' => $permiso],
                    ['guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]
                );
                $this->command->info("Permiso insertado o actualizado: {$permiso}");
            } catch (\Exception $e) {
                $this->command->error("Error al insertar permiso: {$permiso} - ".$e->getMessage());
            }
        }

        try {
            $admin = Role::firstOrCreate(['name' => 'Administrador']);
            $asistente = Role::firstOrCreate(['name' => 'Asistente']);
            $encargado = Role::firstOrCreate(['name' => 'Encargado']);
            $vendedor = Role::firstOrCreate(['name' => 'Vendedor']);

            $admin->syncPermissions(Permission::all());
            $asistente->syncPermissions([
                'ver_compras',
                'crear_compras',
                'ver_envios',
                'crear_envios',
                'aprobar_envios',
                'ver_reportes',
            ]);
            $encargado->syncPermissions([
                'ver_inventario',
                'ver_vencimientos',
                'ver_productos',
                'ver_compras',
                'ver_ventas',
                'realizar_venta',
                'devolver_venta',
                'hacer_cierre',
                'ver_envios',
            ]);
        } catch (\Exception $e) {
            $this->command->error('Error al crear rol administrador: '.$e->getMessage());
        }
    }
}
