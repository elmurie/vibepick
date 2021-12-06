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
        // tabella per poi mettere utenti piú reali
        $utenti = [
            [
                'firstname' => '',
                'lastname' => '',
                'address' => '',
                'phone_number' => '',
            ],
        ];
        for ($i=0; $i<20; $i++) {
            $newUser = new User();
            $newUser->firstname = $faker->firstName(); 
            $newUser->lastname = $faker->lastName();
            $newUser->address = $faker->streetAddress();
            $newUser->phone_number = 3 . $faker->randomNumber(9, true);
            $newUser->email = $faker->email();
            $newUser->password = Hash::make("prova1234");
            $newUser->services = $faker->word();
            $newUser->save();
        }
    }
}
