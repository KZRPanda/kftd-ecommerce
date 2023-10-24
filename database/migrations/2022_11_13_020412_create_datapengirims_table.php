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
        Schema::create('datapengirims', function (Blueprint $table) {
            $table->string("id_pengirim",20);
            $table->string("nama",30);
            $table->string("email",30);
            $table->string("nohp",15);
            $table->string("password",12);
            $table->timestamps();

            $table->primary("id_pengirim");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datapengirims');
    }
};
