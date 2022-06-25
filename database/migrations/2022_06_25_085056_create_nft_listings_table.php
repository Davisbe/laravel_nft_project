<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nft_listings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user')->constrained('users');
            $table->foreignId('nft')->constrained('nft');
            $table->decimal('price',12,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nft_listings');
    }
}
