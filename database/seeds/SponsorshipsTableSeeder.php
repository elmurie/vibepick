<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Riempimento tabella sponsorship con array scritto da noi
        $sponsorships = [
            [
                'name' => 'Bronze Pick',
                'price' => 2.99,
                'duration' => 1,
            ],
            [
                'name' => 'Silver Pick',
                'price' => 5.99,
                'duration' => 3,
            ],
            [
                'name' => 'Gold Pick',
                'price' => 9.99,
                'duration' => 6,
            ],
        ];

        foreach($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->duration = $sponsorship['duration'];
            $newSponsorship->save();
        }
    }
}
