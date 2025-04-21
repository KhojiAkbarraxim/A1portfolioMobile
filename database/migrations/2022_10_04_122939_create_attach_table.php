<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachTable extends Migration
{
    public function up()
    {
        Schema::create('attach', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->constrained("student","id")->onDelete("cascade");
            $table->foreignId("teacher_id")->constrained("professor", "id")->onDelete("cascade");;
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attach');
    }
}
