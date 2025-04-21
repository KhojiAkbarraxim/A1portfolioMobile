<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculte_id')->constrained('facultes')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('name');
        });
    }
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
