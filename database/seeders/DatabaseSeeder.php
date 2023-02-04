<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pet;
use App\Models\User;
use App\Models\Admin;
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

        $date_target = "2023-03-01";

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
            'slug' => 'anjing',
            'admin_id' => 1,

        ]);
        Category::create([
            'name' => 'Kucing',
            'slug' => 'kucing',
            'admin_id' => 1,

        ]);
        
        Pet::create([
            'name' => 'Hewan Kucing',
            'slug' => 'hewan-kucing',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cat1.png',
             'quantity' => 9,
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'available',
        ]);
        Pet::create([
            'name' => 'Hewan Kucing2',
            'slug' => 'hewan-kucing2',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cat2.png',
             'quantity' => 9,
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'available',
        ]);
        Pet::create([
            'name' => 'Hewan Kucing3',
            'slug' => 'hewan-kucing3',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cat3.png',
             'quantity' => 9,
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'available',
        ]);
        Pet::create([
            'name' => 'Hewan Anjing',
            'slug' => 'hewan-anjing',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/dog1.png',
             'quantity' => 8,
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'available',
        ]);
        Pet::create([
            'name' => 'Hewan Anjing2',
            'slug' => 'hewan-anjing2',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/dog2.png',
             'quantity' => 8,
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'available',
        ]);
        Pet::create([
            'name' => 'Hewan Anjing3',
            'slug' => 'hewan-anjing3',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/dog3.png',
             'quantity' => 8,
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'available',
        ]);

        Campaign::create([
            'title' => 'Penyelamatan Anjing Jalanan',
            'slug' => 'penyelamatan-anjing-jalanan',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             voluptatum quo? Dicta qui iste ea rem eos? Pariatur quod officia nisi architecto voluptates. Lorem ipsum, dolor sit amet consectetur adipisicing
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cam1.png',
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'ongoing',
             'donation_target' => 5000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Penyelamatan Anjing Rabies',
            'slug' => 'penyelamatan-anjing-rabies',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             voluptatum quo? Dicta qui iste ea rem eos? Pariatur quod officia nisi architecto voluptates. Lorem ipsum, dolor sit amet consectetur adipisicing
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cam2.png',
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'ongoing',
             'donation_target' => 6000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Penyelamatan Anjing Sakit',
            'slug' => 'penyelamatan-anjing-sakit',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             voluptatum quo? Dicta qui iste ea rem eos? Pariatur quod officia nisi architecto voluptates. Lorem ipsum, dolor sit amet consectetur adipisicing
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cam3.png',
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'ongoing',
             'donation_target' => 7000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Penyelamatan Kucing Jalanan',
            'slug' => 'penyelamatan-kucing-jalanan',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             voluptatum quo? Dicta qui iste ea rem eos? Pariatur quod officia nisi architecto voluptates. Lorem ipsum, dolor sit amet consectetur adipisicing
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cam4.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'ongoing',
             'donation_target' => 5000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Penyelamatan Kucing Rabies',
            'slug' => 'penyelamatan-kucing-rabies',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             voluptatum quo? Dicta qui iste ea rem eos? Pariatur quod officia nisi architecto voluptates. Lorem ipsum, dolor sit amet consectetur adipisicing
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/cam5.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'ongoing',
             'donation_target' => 6000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Penyelamatan Kucing Sakit',
            'slug' => 'penyelamatan-kucing-sakit',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             voluptatum quo? Dicta qui iste ea rem eos? Pariatur quod officia nisi architecto voluptates. Lorem ipsum, dolor sit amet consectetur adipisicing
             elit. Odio, neque omnis quo soluta adipisci nam magnam praesentium omnis atque rem, laudantium voluptatum sunt recusandae',
             'image' => 'images/TdD6BprPFHWGD6xVnP3sp7fiZdARtk8Xw9VNBneW.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'ongoing',
             'donation_target' => 7000000,
             'date_target' => $date_target,
        ]);
    }

}


