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
            'folk',
            'country',
            'blues',
            'funk',
            'jazz',
            'dance',
            "rock'n'roll",
        ];



        //ompilazione tabella utenti tramite Faker
        for ($i=0; $i<25; $i++) {

            //contatori array
            $countSeparator=array_rand($separator, 1);
            $countDom=array_rand($emailDom, 1);
            $countAddress=array_rand($arrAddress, 1);
            $countServices=array_rand($arrServices);
            $countGenre=array_rand($arrGenre);

            //variabili seeder
            $varFirstname=$faker->firstName();
            $varLastname=$faker->lastName();
            $varAddress=$arrAddress[$countAddress] . ' ' . ucwords($faker->words(rand(1,3), true)) . ', ' . rand(1,200);
            $varPhoneNumber= rand(320, 399) . $faker->randomNumber(7, true);
            $varEmail= strtolower($varFirstname . $separator[$countSeparator] . $varLastname . $emailDom[$countDom]);
            $varPassword= Hash::make("prova1234");

            //--per avere sempre array con elementi posizioneti in diverso modo: servizi e generi
            shuffle($arrServices);
            
            if($countServices==0){
                $countServices=1;
            }

            $varServices=[];
            for($j=0; $j<$countServices; $j++) {
                $varServices[] = ucfirst($arrServices[$j]);
            }

            shuffle($arrGenre);
            
            if($countGenre==0){
                $countGenre=1;
            }

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
            $newUser->curriculum = 'Esperienza di '. rand(1, 7) . ' anni nel campo della musica. I miei generi preferiti sono: '. implode(', ', $varGenre). '. Mi occupo principalmente di '. strtolower(implode(', ', $varServices)).'.'; 
            $newUser->save();
        }
    }
}

