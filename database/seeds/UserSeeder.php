<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => '1',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'), // password
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'esteban',
            'email' => 'esteban3@gmail.com',
            'role_id' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('esteban3'), // password
            'remember_token' => Str::random(10)
        ]);
        factory(User::class,10)->create();
    }
}
