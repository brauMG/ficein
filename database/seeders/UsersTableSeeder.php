<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Braulio',
            'last_name' => 'Martinez',
            'email' => 'braulio@firefish.com.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('T3rr0n.2022.FF'),
            'type' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Octavio',
            'last_name' => 'Ruiz',
            'email' => 'desarrollo.ficein@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('si$tema.fice_in$2022'),
            'type' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
