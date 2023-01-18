<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->insert([
            'id' => Str::uuid(),
            'name' => 'Dummy Member',
            'email' => 'member@email.com',
            'password' => Hash::make('dummydummy'),
            'role' => 'Member',
            'created_at' => now()
        ]);
        User::query()->insert([
            'id' => Str::uuid(),
            'name' => 'Dummy Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('dummydummy'),
            'role' => 'Admin',
            'created_at' => now()
        ]);

        $this->call([
            ProductTypeSeeder::class,
            ProductSeeder::class
        ]);

    }
}
