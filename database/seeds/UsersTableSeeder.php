<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        App\User::create([
            'firstname' => 'Jorge I.',
            'lastname' => 'Meza',
            'email' => 'jimezam@gmail.com',
            'password' => Hash::make('hola123'),
            'country_id' => '45',
        ]);
    }
}
