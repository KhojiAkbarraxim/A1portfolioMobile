<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('group_id')->constrained('group')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('phone');
            $table->tinyInteger('attach_status')->default(0);
            $table->tinyInteger('status')->nullable(1);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
