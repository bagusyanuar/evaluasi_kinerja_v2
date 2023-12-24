<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'username' => 'super',
            'roles'    => ['superuser'],
            'email'    => 'super@gmail.com',
            'password' => Hash::make('super'),
        ]);

        $user->superuser()->create([
           'name' => 'Super User'
        ]);
    }
}
