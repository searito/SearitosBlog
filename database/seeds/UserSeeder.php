<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name' => 'Usuario De Prueba',
            'email' => 'prueba@yahoo.com',
            'password' => bcrypt('Prueba_12345'),
            'type' => 'member',
            'nick' => 'TestUser',
        ]);*/

        factory(App\User::class, 25)->create();
    }
}
