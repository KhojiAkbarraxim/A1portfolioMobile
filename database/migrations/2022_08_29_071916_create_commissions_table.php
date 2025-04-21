<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTable extends Migration
{
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->constrained('announcement');
            $table->string('name');
            $table->string('phone');
            $table->boolean('status');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('commissions');
    }
}
