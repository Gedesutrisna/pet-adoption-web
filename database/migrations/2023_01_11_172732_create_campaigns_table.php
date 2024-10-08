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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_body');
            $table->text('body');
            $table->string('image')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('admin_id');
            $table->integer('donation_target')->nullable();
            $table->date('date_target')->nullable();
            $table->enum('status', ['Ongoing', 'Completed'])->default('Ongoing');
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
        Schema::dropIfExists('campaigns');
    }
};
