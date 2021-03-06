<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('secret'),
            'role_id' => 1
        ]);

        Role::create([
            'name' => 'User',
            'description' => 'User'
        ]);

        Role::create([
            'name' => 'Admin',
            'description' => 'admin'
        ]);
    }
}
