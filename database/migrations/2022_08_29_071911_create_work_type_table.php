<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkTypeTable extends Migration
{
    public function up()
    {
        Schema::create('work_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scale_id')->constrained('work_scale')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('name');
        });
    }
    public function down()
    {
        Schema::dropIfExists('work_type');
    }
}
