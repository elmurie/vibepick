<?php

use Illuminate\Database\Seeder;
use App\Review;
use Faker\Generator as Faker;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //array per compilare tabella recensioni
        $goodArtist = [
            'Eccellente',
            'Ottimo'
        ];

        $normalArtist = [
            'Molto professionale',
            'Professionale',
            'Consiglio'
        ];

        $badArtist = [
            'Poco professionale',
            'Pensavo meglio',
            'Sconsiglio'
        ];

        $goodTxt = [
            'Ottima esperienza, molto professionale. Consiglio a tutti',
            'Assolutamente perfetto: rapido, preciso, e soprattutto con un talento raro.',
            'Tecnica perfetta, passione per la musica e per il proprio lavoro'
        ];
        $normalTxt = [
            'Puntuale, preciso e professionale. Consiglio a tutti',
            'Non è il top ma per il prezzo direi molto bene'
        ];
        $badTxt = [
            'Poca professionalità, ci siamo trovati malissimo',
            'Dice di saper suonare ma in realtà non è vero',
            "Rapporto performance-prezzo pessimo. Sconsiglio"
        ];

        //compilazione tabella recensioni
        for ( $i = 0; $i < 60; $i++ ) {

            //contatori array
            $countGood=array_rand($goodArtist, 1);
            $countNormal=array_rand($normalArtist, 1);
            $countBad=array_rand($badArtist, 1);
            $countGoodText=array_rand($goodTxt, 1);
            $countNormalText=array_rand($normalTxt, 1);
            $countbadText=array_rand($badTxt, 1);


            //variabili seeder
            $varUser_id = $faker-> numberBetween(1, 25);
            $varName = $faker->name();
            $varVote = $faker->numberBetween(0, 5);

            switch ($varVote) {

                case (0):
                case (1):
                case (2):
                    $varTitle=$badArtist[$countBad];
                    $varContent=$badTxt[$countbadText];
                    break;

                case (3):
                    $varTitle=$normalArtist[$countNormal];
                    $varContent=$normalTxt[$countNormalText];
                    break;

                case (4):
                case (5):
                    $varTitle=$goodArtist[$countGood];
                    $varContent=$goodTxt[$countGoodText];
                    break;
            }

            
            //SEEDER
            $newReview = new Review();
            $newReview->user_id = $varUser_id;
            $newReview->author = $varName;
            $newReview->vote = $varVote;
            $newReview->title = $varTitle;
            $newReview->content = $varContent;
            $newReview->save();
            
        }
    }
}
