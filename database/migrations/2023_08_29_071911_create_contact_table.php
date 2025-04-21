<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('subject');
            $table->string('message');
            $table->timestamps();
        });
    }   
    public function down()
    {
        Schema::dropIfExists('contact');
    }
};
