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
        Schema::create('users_messages', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('messages_id')->references('id')->on('messages');
        });

        DB::unprepared('ALTER TABLE users_messages DROP PRIMARY KEY, ADD PRIMARY KEY ( users_id , messages_id )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_messages');
    }
};
