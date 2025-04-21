<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student','id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('teacher_id')->constrained('professor','id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('work_id')->constrained('work',)->onDelete('cascade')->onUpdate('cascade');
            $table->text('message');
            $table->timestamp('date');
            $table->integer('status')->default(-1);
            $table->text('answer')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('comment');
    }
};
