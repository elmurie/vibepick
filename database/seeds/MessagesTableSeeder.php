<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;
use Illuminate\Mail\Events\MessageSent;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ( $i = 0; $i < 40; $i++ ) {

            $newMessage = new Message();
            $newMessage->user_id = $faker->numberBetween(1, 20);
            $newMessage->firstname = $faker->firstName();
            $newMessage->lastname = $faker->lastName(); 
            $newMessage->email = $faker->email(); 
            $newMessage->text = $faker->words(40, true); 
            $newMessage->save();
        }
    }
}
