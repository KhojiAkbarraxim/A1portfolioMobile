<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('group', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('faculte_id')->constrained('facultes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('direction_id')->constrained('directions')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('group');
    }
};
