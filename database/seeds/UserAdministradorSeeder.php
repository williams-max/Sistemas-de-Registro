<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\isarel\Models\Rola;
use App\isarel\Models\Permission;
use Illuminate\Support\Facades\Hash;


class UserAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
        DB::table('users')->insert([
            'id' => '1000',
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('laravel'), 
          ]);
          
          
          DB::table('roles')->insert([
            'id' => '2000',
            'name' => 'Administrador',
          ]);  

          DB::table('role_user')->insert([
            'user_id' => '1000',
            'role_id' => '2000',
          ]);  
          */

         //apagamos los foreing
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //truncate vacia la tabla
         DB::table('rola_user')->truncate();
         DB::table('permission_rola')->truncate();
         Permission::truncate();
         Rola::truncate();
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
          //codigo escrito por israel

          $useradmin= User::where('email','jadmin@admin.com')->first(); 
          if($useradmin){
            $useradmin->delete();
          }
          $useradmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' =>  Hash::make('laravel')
            
         ]);

          //rol admin
         $roladmin= Rola::create([
          'name' => 'admin',
          //'slug' => 'admin',
          'description' => 'administrador',
           'full-access' => 'yes'
  
        ]);
         //pasamos ese rol unico al usuario
         //table role_user
        $useradmin->rolas()->sync([$roladmin->id]);

           //permission
          $permission_all = [];

            
             $permission = Permission::create([
              'name' => 'Lista de Roles',
              'slug' => 'rola.index',
              'description' => 'Usted puede ver la lista de Roles',
            ]);
            $permission_all[] = $permission->id;


             

            $permission = Permission::create([
            'name' => 'Ver Rol',
            'slug' => 'rola.show',
            'description' => 'Usted puede ver un Rol',
            ]);
            $permission_all[] = $permission->id;

            $permission = Permission::create([
              'name' => 'Crear Rol',
              'slug' => 'rola.create',
              'description' => 'Usted puede crear un Roles',
              ]);
              $permission_all[] = $permission->id;

            $permission = Permission::create([
            'name' => 'Editar Rol',
            'slug' => 'rola.edit',
            'description' => 'Usted puede Editar un Roles',
            ]);
            $permission_all[] = $permission->id;

            $permission = Permission::create([
            'name' => 'Emilinar Roles',
            'slug' => 'rola.destroy',
            'description' => 'Usted puede Eliminar un Rol',
            ]);
            $permission_all[] = $permission->id;
            

            //permisos_para los user
           
              //Vacio
            
       
             // Permisos de las rotes  Permisos Personal Academico
            $permission = Permission::create([
              'name' => 'Lista de Personal Academico',
              'slug' => 'personalAcademico.index',
              'description' => 'Usted Puede ver la lista del personal Academico',
              ]);
              $permission_all[] = $permission->id;

              $permission = Permission::create([
                'name' => 'Eliminar personal Academico',
                'slug' => 'personalAcademico.destroy',
                'description' => 'Usted puede eliminar Personal Academico',
                ]);
                $permission_all[] = $permission->id;

                $permission = Permission::create([
                  'name' => 'Crear personal Academico',
                  'slug' => 'personalAcademico.create',
                  'description' => 'Usted puede Crear Personal Academico',
                  ]);
                  $permission_all[] = $permission->id;

              //Permisos para Unidad ,Faculdad y Carrera
              
              $permission = Permission::create([
                'name' => 'Registrar Unidad Faculdad Carrera',
                'slug' => 'registrarUFC.index',
                'description' => 'Usted puede Registrar UFC',
                ]);
                $permission_all[] = $permission->id;

                
                $permission = Permission::create([
                  'name' => 'Registrar Unidad ',
                  'slug' => 'registrarUFC/registrarUnidad',
                  'description' => 'Usted puede Registrar Unidad',
                  ]);
                  $permission_all[] = $permission->id;

                  $permission = Permission::create([
                    'name' => 'Registrar Faculdad ',
                    'slug' => 'registrarUFC/registrarFacultad',
                    'description' => 'Usted puede Registrar  una o mas faculdades',
                    ]);
                    $permission_all[] = $permission->id;

                    $permission = Permission::create([
                      'name' => 'Registrar Carrera ',
                      'slug' => 'registrarUFC/registrarCarrera',
                      'description' => 'Usted puede Registrar una mas Carreras',
                      ]);
                      $permission_all[] = $permission->id;
      //table permission_rola
     // $roladmin->permissions()->sync( $permission_all );
        
    }
}
