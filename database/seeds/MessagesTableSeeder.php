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
        //array per compilare tabella messaggi



        //compilazione tabella messaggi
        for ($i = 0; $i <40; $i++) {
            //contatori array
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
            
            $firstGreeting = [
                'Buongiorno',
                'Salve',
                'Buonasera',
            ];

            $firstReason = [
                'sapere se è disponibile per una collaborazione',
                'sapere è disponibile per una data del mio tour',
                'avere informazioni riguardo i prezzi per una serata',
                'chiederle in che giorni è disponibile per avere delle lezioni',
            ];

            $secondReason = [
                'il suo tariffario',
                "se è possibile fissare un incontro per approfondire l'argomento",
                'se le interessa registrare nel mio studio'
            ];

            $secondGreeting = [
                'Saluti',
                'A presto',
                'Attendo sue notizie'
            ];

            //contatori array
            $countSeparator=array_rand($separator, 1);
            $countDom=array_rand($emailDom, 1);
            $countFirstG=array_rand($firstGreeting, 1);
            $countFirstR=array_rand($firstReason, 1);
            $countSecondG=array_rand($secondGreeting, 1);
            $countSecondR=array_rand($secondReason, 1);


            //variabili seeder
            $varUser_id =$faker->numberBetween(1, 25);
            $varFirstname=$faker->firstName();
            $varLastname=$faker->lastName();
            $varEmail= strtolower($varFirstname . $separator[$countSeparator] . $varLastname . $emailDom[$countDom]);
            
            $varTxt1 = $firstGreeting[$countFirstG] . '. La contatto per ' . $firstReason[$countFirstR];
            $varText2 = '. Vorrei sapere inoltre ' . $secondReason[$countSecondR] . '. '. $secondGreeting[$countSecondG];
            $varText = $varTxt1 . $varText2 . '.';
            
            //SEEDER
            $newMessage = new Message();
            $newMessage->user_id = $varUser_id;
            $newMessage->firstname = $varFirstname;
            $newMessage->lastname = $varLastname;
            $newMessage->email = $varEmail; 
            $newMessage->text = $varText;
            $newMessage->save();
        }


    }
}
