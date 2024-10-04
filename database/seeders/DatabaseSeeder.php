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

        $date_target = "2025-04-30";

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'name' => 'user',
            'username' => 'user',
            'phone' => 1234512345123,
            'email' => 'user@gmail.com',
            'password' => bcrypt('123'),
            'image' => '',
        ]);

        Category::create([
            'name' => 'Dog',
            'slug' => 'dog',
            'admin_id' => 1,

        ]);
        Category::create([
            'name' => 'Cat',
            'slug' => 'cat',
            'admin_id' => 1,

        ]);
        Pet::create([
            'name' => 'Jack',
            'slug' => 'jack',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/dog4.png',
             'quantity' => 9,
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Available',
        ]);
        
      
        Pet::create([
            'name' => 'Sigit',
            'slug' => 'sigit',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/cat2.png',
             'quantity' => 9,
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Available',
        ]);
        Pet::create([
            'name' => 'Tom',
            'slug' => 'tom',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/cat3.png',
             'quantity' => 9,
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Available',
        ]);
       
        Pet::create([
            'name' => 'Whiskers',
            'slug' => 'whiskers',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/cat1.png',
             'quantity' => 9,
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Available',
        ]);
        Pet::create([
            'name' => 'Max',
            'slug' => 'max',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/dog1.png',
             'quantity' => 8,
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Available',
        ]);
        Pet::create([
            'name' => 'Bella',
            'slug' => 'bella',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/dog2.png',
             'quantity' => 8,
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Available',
        ]);
        Pet::create([
            'name' => 'Bob',
            'slug' => 'bob',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/dog5.png',
             'quantity' => 8,
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Available',
        ]);
        Pet::create([
            'name' => 'Brembo',
            'slug' => 'brembo',
            'short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis 
             neque architecto totam mollitia omnis corporis, aliquam quaerat maxime? Illum nostrum rerum voluptas cum, tenetur architecto reprehenderit,
             et fuga, delectus modi animi odit incidunt voluptates vel corrupti. Dolor in similique ipsum! Quia aut quasi, architecto harum officia
             elit.',
             'image' => '/pet/dog3.png',
             'quantity' => 8,
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Available',
        ]);

        Campaign::create([
            'title' => 'Rescue Stray Cats',
            'slug' => 'Rescue-Stray-Cats',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam1.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 5000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Love for Felines   ',
            'slug' => 'Love-for-Felines',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam2.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 6000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Save the Cats',
            'slug' => 'save-the-cats',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam3.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 7000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Pity the Street Cat',
            'slug' => 'pity-the-street-cat',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam6.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 7000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Caring for Abandoned Cats',
            'slug' => 'Caring-for-Abandoned-Cats',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam7.png',
             'category_id' => 2,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 5000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Save Abandoned Dogs',
            'slug' => 'Save-Abandoned-Dogs',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam4.png',
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 6000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Hope for Homeless Dogs',
            'slug' => 'Hope-for-Homeless-Dogs',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam5.png',
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 7000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Protect dogs and Donate Now',
            'slug' => 'protect-dogs-and-donate-now',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam8.png',
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 7000000,
             'date_target' => $date_target,
        ]);
        Campaign::create([
            'title' => 'Save Paws Rescue ',
            'slug' => 'save-paws-rescue',
            'short_body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing
        ',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing Reiciendis
             voluptas blanditiis, perferendis illo 
             voluptas blanditiis, perferendis illo 
             voluptas blanditiis, perferendis illo 
             voluptas blanditiis, perferendis illo 
             voluptas blanditiis, perferendis illo 
             voluptas blanditiis, perferendis illo 
             laborum nam officiis. Accusamus expedita maiores minima repudiandae explicabo iure, qui fugit tempore doloremque? Tempore provident ipsa ',
             'image' => '/cam/cam9.png',
             'category_id' => 1,
             'admin_id' => 1,
             'status' => 'Ongoing',
             'donation_target' => 7000000,
             'date_target' => $date_target,
        ]);
    }

}


