<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
             'name' => 'Cédric',
             'password' => Hash::make('123456789'),
             'email' => 'limacedric@hotmail.fr',
         ]);

         $names = [
             'Bob',
             'Fred',
             'Xav',
             'Marie',
             'Camille',
         ];

         for ($i = 0; $i < 5; $i++) {
             User::factory()->create([
                 'name' => $names[rand(0,4)],
                 'use_rt' => rand(0,100),
                 'password' => Hash::make('123456789'),
                 'email' => rand(0,9999) . '@hotmail.fr',
             ]);
         }
    }
}
