<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trans_id');
            $table->unsignedBigInteger('room_id');
            $table->integer('days');
            $table->decimal('sub_total_room', 8, 2);
            $table->decimal('extra_charge', 8, 2);
            $table->timestamps();

            $table->foreign('trans_id')->references('id')->on('transactions');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}
