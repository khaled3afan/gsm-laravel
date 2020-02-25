<?php

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
         $this->call(servicTypesSeeder::class);
         $this->call(createAdminSeeder::class);
         $this->call(ServicesSeeder::class);
         $this->call(CategorySeeder::class);
    }
}
