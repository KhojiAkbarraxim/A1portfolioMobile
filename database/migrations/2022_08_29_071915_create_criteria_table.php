<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriteriaTable extends Migration
{
    public function up()
    {
        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->constrained('announcement','id');
            $table->string('name');
            $table->integer('score');
        });
    }
    public function down()
    {
        Schema::dropIfExists('criteria');
    }
}
