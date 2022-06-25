<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaceHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchace_history', function (Blueprint $table) {
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
        Schema::dropIfExists('purchace_history');
    }
}
