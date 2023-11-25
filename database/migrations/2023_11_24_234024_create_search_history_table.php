<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('search_history', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email_address');
            $table->integer('questions_amount');
            $table->string('select_difficulty');
            $table->string('select_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('search_history');
    }
}