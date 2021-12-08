<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Instrument;

class InstrumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //array per la creazione degli strumenti
        $instruments = ['Basso', 'Batteria', 'Chitarra Elettrica', 'Chitarra Classica', 'Fisarmonica', 'Flauto', 'Pianoforte', 'Sassofono', 'Sax', 'Tamburo', 'Tastiera', 'Tromba', 'Violino', 'Vuvuzela', 'Controller DJ'];

        //ciclo sull'array degli strumenti per il riempimento della tabella degli strumenti
        foreach($instruments as $instrument) {
            $newInstrument = new Instrument();
            $newInstrument->name = $instrument;
            $newInstrument->slug = Str::of($newInstrument->name)->slug('-');
            $newInstrument->save();
        }
    }
}
