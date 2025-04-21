<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('facultes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }
    public function down()
    {
        Schema::dropIfExists('facultes');
    }
};
