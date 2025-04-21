<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('itb_bolim', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }   
    public function down()
    {
        Schema::dropIfExists('itb_bolim');
    }
};
