<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users')->insertGetId([
            'email' => "luis.pineda@ceindetec.org.co",
            'password' => bcrypt('123'),
            'rol' => "SuperAdmin",
        ]);
        DB::table('personas')->insert([
            'documento' => "1120564482",
            'nombre' => "luis carlos",
            'apellido' => "pineda",
            'telefono' => "3138585565",
            'user_id' => $id,
        ]);
    }
}
