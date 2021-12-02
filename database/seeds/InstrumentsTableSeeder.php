<?php

use Illuminate\Database\Seeder;
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
        $instruments = ['Basso', 'Batteria', 'Chitarra classica', 'Chitarra Elettrica', 'Chitarra Classica', 'Fisarmonica', 'Flauto', 'Pianoforte', 'Sassofono', 'Sax', 'Tamburo', 'Tastiera', 'Tromba', 'Violino', 'Vuvuzela', 'Controller DJ'];

        foreach($instruments as $instrument) {
            $newInstruments = new Instrument();
            $newInstruments->name = $instrument;
            $newInstruments->save();
        }
    }
}
