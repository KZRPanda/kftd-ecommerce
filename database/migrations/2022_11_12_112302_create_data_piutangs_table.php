<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_piutangs', function (Blueprint $table) {
            $table->string("id_piutang",20);
            $table->string("id_pesanan",20);
            $table->string("username",20);
            $table->double("total");
            $table->integer("lama");
            $table->timestamps();

            $table->primary("id_piutang");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_piutangs');
    }
};
