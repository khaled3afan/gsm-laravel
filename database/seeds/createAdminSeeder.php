<?php

use Illuminate\Database\Seeder;
use App\User;
class createAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'khaled affan',
            'email' => 'khaled3afan@gmail.com',
            'password' => bcrypt('khaled3afan'),
            'is_admin' => true

        ]);
    }
}
