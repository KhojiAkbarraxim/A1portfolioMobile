<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkScaleTable extends Migration
{
    public function up()
    {
        Schema::create('work_scale', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }
    public function down()
    {
        Schema::dropIfExists('work_scale');
    }
}
