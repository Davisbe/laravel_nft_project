<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nft', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 50)->nullable();
            $table->foreignId('collection_id')->constrained('collections');
            $table->foreignId('owner')->nullable()->constrained('users');
            $table->string('file_path', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nft');
    }
}
