<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\isarel\Models\Rola;
use App\isarel\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Mata;


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
        
        DB::table('fecha_entregas')->insert([
            'id' => '1',
            'fecha_inicio' => '2021/01/11',
            'fecha_entrega' => '2021/01/25', 
          ]);
          DB::table('dias')->insert([
            'id' => '1',
            'dia' => 'lunes',
          ]);
          DB::table('dias')->insert([
            'id' => '2',
            'dia' => 'martes',
          ]);
          DB::table('dias')->insert([
            'id' => '3',
            'dia' => 'miercoles',
          ]);
          DB::table('dias')->insert([
            'id' => '4',
            'dia' => 'jueves',
          ]);
          DB::table('dias')->insert([
            'id' => '5',
            'dia' => 'viernes',
          ]);
          DB::table('dias')->insert([
            'id' => '6',
            'dia' => 'sabado',
          ]);
         /* 
          
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

          $useradmin= User::where('email','admin@admin.com')->first(); 
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

                      //permisos Registrar Autoridades Academicas

                      $permission = Permission::create([
                        'name' => 'Registrar Autoridades Academicas ',
                        'slug' => 'autoAcademicas.index',
                        'description' => 'Usted puede Registrar Autoridades Academicas',
                        ]);
                        $permission_all[] = $permission->id;

                        //persimos para REgistro de asistencia Axuiliar
                        $permission = Permission::create([
                          'name' => 'Registro de asistencia Docente ',
                          'slug' => 'registroAsistenciaDocente.index',
                          'description' => 'Usted puede llenar el registro de asistencia Docente',
                          ]);
                          $permission_all[] = $permission->id;
                           //persimos para REgistro de asistencia Docente
                        $permission = Permission::create([
                          'name' => 'Registro de asistencia Auxiliar ',
                          'slug' => 'registroAsistenciaAuxiliar.index',
                          'description' => 'Usted puede llenar el registro de asistencia Auxliar',
                          ]);
                          $permission_all[] = $permission->id;
                        
                            //plan mensual de asistencia docentes
                            $permission = Permission::create([
                              'name' => 'Plan mensual de asistencia docentes ',
                              'slug' => 'ReporteController@index',
                              'description' => 'Usted puede ver  el Plan mensual de asistencia docentes',
                              ]);
                              $permission_all[] = $permission->id;
                                 //formulario de resumen a clase virtuales solo para docentes
                            $permission = Permission::create([
                              'name' => 'Formulario resumen de faltas a clases virtuales solo para docentes ',
                              'slug' => 'ResumenfaltaController@index',
                              'description' => 'Usted puede ver formulario de resumen a clase virtuales ',
                              ]);
                              $permission_all[] = $permission->id;
        
    }
}
