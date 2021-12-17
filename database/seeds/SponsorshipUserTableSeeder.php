<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SponsorshipUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $arrayUser = [];
        for( $i=1; $i<11; $i++) {
            $randomUser=rand(1, 25);
            $randomSponsor=rand(1,3);

            //settaggio giorni start e end
            date_default_timezone_set('Europe/Rome'); //fuso orario italiano
            $tmp1=date("Y-m-d H:i:s"); //data di oggi in una variabile temporanea 
            $dateMin = new DateTime($tmp1); // attribuzione la data di oggi a dateMin settandola con new DateTime

            $dateTimeStamp = rand(2, 7); //numero randomico tra 2 e 7
            $dateMax = date_modify($dateMin,  "+$dateTimeStamp days"); //imposto la dateMax modificando la tmp2, che ha il valore di dateMin, aggiungendo il numero casuale

            
            $tmp2=date("Y-m-d H:i:s"); //data di oggi in una variabile temporanea 
            $endDateMin = new DateTime($tmp2); // attribuzione la data di oggi a dateMin settandola con new DateTime
            $endDateMax = date_modify($endDateMin,  "+$dateTimeStamp days"); //imposto la dateMax modificando la tmp2, che ha il valore di dateMin, aggiungendo il numero casuale
            
            switch ($randomSponsor) {

                case (1):
                    $lastDate = date_modify($endDateMax,  "+1 days");
                    break;

                case (2):
                    $lastDate = date_modify($endDateMax,  "+3 days");                    
                    break;

                case (3):
                    $lastDate = date_modify($endDateMax,  "+6 days");
                    break;
            }

            
            if(!in_array($randomUser, $arrayUser)) {

                DB::table('sponsorship_user')->insert([
                    'sponsorship_id'=>$randomSponsor,
                    'user_id'=>$randomUser,
                    'start_time'=>$dateMax,
                    'end_time' =>$lastDate
                ]);

                $arrayUser[] = $randomUser;
            } else {
                $i--;
            }
        }
    }
}
