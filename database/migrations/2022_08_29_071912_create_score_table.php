<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreTable extends Migration
{
    public function up()
    {
        Schema::create('score', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('work_type')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('ball');
        });
    }
    public function down()
    {
        Schema::dropIfExists('score');
    }
}
