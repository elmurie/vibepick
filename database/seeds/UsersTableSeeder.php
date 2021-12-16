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
        $separator = [
            '.',
            '_'
        ];

        $emailDom = [
            '@gmail.it',
            '@gmail.com',
            '@outlook.it',
            '@outlook.com',
            '@hotmail.it',
            '@hotmail.com',
            '@live.it',
            '@live.com',
        ];
    
        $arrAddress = [
            'Via',
            'Piazza',
            'Viale',
        ];

        $arrServices = [
            'registrazione in studio',
            'composizione colonne sonore',
            'composizione jingle',
            'turnista per tours musicali',
            'piano bar feste private',
            'collaborazioni musicali',
            'lezioni private',
        ];

        $arrGenre = [
            'classica',
            'rock',
            'metal',
            'rap',
            'pop',
            'indie',
            'folck',
            'country',
            'blues',
            'funky',
            'jazz',
            'dance',
            "rock'n'roll",
        ];


        //Riempimento tabella utenti tramite Faker
        for ($i=0; $i<25; $i++) {

            //contatori array
            $countAddress=array_rand($arrAddress, 1);
            $countSeparator=array_rand($separator, 1);
            $countDom=array_rand($emailDom, 1);
            $countServices=array_rand($arrServices);
            $countGenre=array_rand($arrGenre);

            //variabili seeder
            $varFirstname=$faker->firstName();
            $varLastname=$faker->lastName();
            $varAddress=$arrAddress[$countAddress] . ' ' . ucwords($faker->words(rand(1,3), true)) . ', ' . rand(1,200);
            $varPhoneNumber='+39 ' . rand(320, 399) . $faker->randomNumber(7, true);
            $varEmail= $varFirstname . $separator[$countSeparator] . $varLastname . $emailDom[$countDom];
            $varPassword= Hash::make("prova1234");

            //--per avere sempre array con elementi posizioneti in diverso modo
            shuffle($arrServices);
            
            if($countServices==0){
                $countServices=1;
            }

            $varServices=[];
            for($j=0; $j<$countServices; $j++) {
                $varServices[] = ucfirst($arrServices[$j]);
            }

            if($countGenre==0){
                $countGenre=1;
            }

            shuffle($arrGenre);
            $varGenre=[];
            for($j=0; $j<$countGenre; $j++) {
                $varGenre[] = ucfirst($arrGenre[$j]);
            }

            //SEEDER
            $newUser = new User();
            $newUser->firstname = $varFirstname;
            $newUser->lastname = $varLastname;
            $newUser->address = $varAddress;
            $newUser->phone_number = $varPhoneNumber;
            $newUser->email = $varEmail;
            $newUser->password = $varPassword;
            $newUser->services = implode('. ', $varServices).'.';
            $newUser->genre = implode('. ', $varGenre);
            $newUser->save();
        }
    }
}
