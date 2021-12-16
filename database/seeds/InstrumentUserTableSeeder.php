<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class InstrumentUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<26; $i++) {

            do {
                $randomNum=rand(1, 15);
                $randomNumCount=rand(1,15);
            } while ($randomNum<=$randomNumCount || ($randomNum - $randomNumCount > 5));

            $arrayInstrument = [];
            for($j=$randomNumCount; $j<$randomNum; $j++) {
                $numInstrument = rand(1, 15);
                if(in_array($numInstrument, $arrayInstrument)){
                    $j++;
                } else {
                    DB::table('instrument_user')->insert([
                        'instrument_id'=>$numInstrument,
                        'user_id'=>$i
                    ]);
                }
                $arrayInstrument[] = $numInstrument;
            }
        }
    }
}
