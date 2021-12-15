<?php

//Tabella pivot per la relazione Many-toMany tra utenti e sponsorizzazioni

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorship_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");

            $table->unsignedBigInteger('sponsorship_id');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->onDelete("cascade");

            $table->dateTime('start_time')->default('2006-07-09 22:55:19'); //inclusione del dato 'inizio sponsorizzazione'
            $table->dateTime('end_time')->default('2006-07-09 23:55:19'); //inclusione del dato 'fine sponsorizzazione'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsorship_user');
    }
}
