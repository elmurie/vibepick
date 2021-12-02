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
        for ($i=0; $i<20; $i++) {
            $newUser = new User();
            $newUser->firstname = $faker->firstName(); 
            $newUser->lastname = $faker->lastName();
            $newUser->address = $faker->streetAddress();
            $newUser->profile_pic = $faker->imageUrl();
            $newUser->phone_number = $faker->randomNumber(9, true);
            $newUser->email = $faker->email();
            $newUser->password = Hash::make("prova1234");
            $newUser->services = $faker->word();
            $newUser->save();
        }
    }
}
