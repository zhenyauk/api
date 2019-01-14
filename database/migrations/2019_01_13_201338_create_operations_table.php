<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_id');
            $table->integer('currency')->nullable();
            $table->string('operation')->nullable(); //plus minus
            $table->integer('amount')->nullable(); //100
            $table->integer('amount_cents')->default(00); //100
            $table->string('hash')->nullable();
            $table->text('info')->nullable();
            $table->text('log')->nullable();
            $table->string('hash')->nullable();
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
        Schema::dropIfExists('operations');
    }
}
