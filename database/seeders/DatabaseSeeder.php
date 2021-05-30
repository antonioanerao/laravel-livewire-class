<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

         for($i=0;$i<=100;$i++) {
             \App\Models\Comments::create([
                 'title' => Str::random(10),
                 'body' => Str::random(50),
                 'user_id' => 1,
             ]);
         }
    }
}
