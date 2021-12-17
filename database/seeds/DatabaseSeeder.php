<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            InstrumentsTableSeeder::class,
            MessagesTableSeeder::class,
            ReviewsTableSeeder::class,
            SponsorshipsTableSeeder::class,
            InstrumentUserTableSeeder::class,
            SponsorshipUserTableSeeder::class,
        ]);
    }
}
