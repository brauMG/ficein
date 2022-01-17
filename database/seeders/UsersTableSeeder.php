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
            'password' => Hash::make('asdasdasd'),
            'type' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User 1',
            'last_name' => 'From Test',
            'email' => 'user1@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasdasd'),
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User 2',
            'last_name' => 'From Test',
            'email' => 'user2@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasdasd'),
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User 3',
            'last_name' => 'From Test',
            'email' => 'user3@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasdasd'),
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User 4',
            'last_name' => 'From Test',
            'email' => 'user4@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasdasd'),
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User 5',
            'last_name' => 'From Test',
            'email' => 'user5@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasdasd'),
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
