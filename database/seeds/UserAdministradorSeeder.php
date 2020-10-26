<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        
    }
}
