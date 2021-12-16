<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Array per riempire la tabella utenti con dati verosimili
        

        //Riempimento tabella utenti tramite Faker
        
        for ($i=0; $i<20; $i++) {
            $newUser = new User();
            $newUser->firstname = $faker->firstName(); 
            $newUser->lastname = $faker->lastName();
            $newUser->address = $faker->streetAddress();
            $newUser->phone_number = rand(320, 399) . $faker->randomNumber(7, true); //inizio numero con 3 per verosimiglianza con i numeri di cellulare italiani
            $newUser->email = $faker->email();
            $newUser->password = Hash::make("prova1234"); //password standard per accedere a tutti gli utenti generati automaticamente dal seeder
            $newUser->services = $faker->word();
            $newUser->save();
        }
    }
}
