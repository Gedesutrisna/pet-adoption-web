<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pet;
use App\Models\User;
use App\Models\Admin;
use App\Models\Donate;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Campaign;
use App\Models\Category;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'user',
            'username' => 'user',
            'phone' => 1234512345123,
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'image' => '',
        ]);

        Category::create([
            'name' => 'Anjing',
            'slug' => 'anjing'
        ]);
        Category::create([
            'name' => 'Kucing',
            'slug' => 'kucing'
        ]);

    }

}


