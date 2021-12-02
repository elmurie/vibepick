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
        for ( $i = 0; $i < 60; $i++ ) {
            $author = $faker->name();
            $newReview = new Review();
            $newReview->user_id = $faker->numberBetween(1, 20);
            $newReview->title = "Recensione di " . $author;
            $newReview->author = $author;
            $newReview->content = $faker->words(40, true);
            $newReview->vote = $faker->numberBetween(0, 5);
            $newReview->save();
        }
    }
}
