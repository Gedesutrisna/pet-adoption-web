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
        Schema::create('donates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('adoption_id')->nullable();
            $table->foreignId('shelter_id')->nullable();
            $table->foreignId('campaign_id')->nullable();
            $table->integer('amount');
            $table->string('name');
            $table->string('email');
            $table->text('comment')->nullable();
            $table->enum('status', ['unpaid', 'paid',])->default('unpaid');
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
        Schema::dropIfExists('donates');
    }
};
