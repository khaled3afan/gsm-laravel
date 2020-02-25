<?php

use Illuminate\Database\Seeder;
use \App\ServiceType;

class servicTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceTypes= ['instant', 'delay'];
        foreach($serviceTypes as $serviceType) {
        ServiceType::create([
            'name' => $serviceType
        ]);
        }
    }
}
